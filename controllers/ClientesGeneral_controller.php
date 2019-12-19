<?php

class ClientesGeneral_controller extends Controller {

    public function Agregar($origen) {
        $data = array();
        $busqueda_cliente = Clientes::where('empresa', $_POST['empresa']);
        if (!empty($busqueda_cliente)) {
            array_push($data, array(
                'respuesta' => '1',
            ));
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
        }
        $busqueda_cliente = Clientes::where('correo_principal', $_POST['correo_principal']);
        if (!empty($busqueda_cliente)) {
            array_push($data, array(
                'respuesta' => '2',
            ));
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
        }
        $busqueda_cliente = Clientes::where('telefono', $_POST['telefono']);
        if (!empty($busqueda_cliente)) {
            array_push($data, array(
                'respuesta' => '3',
            ));
            echo json_encode($data, JSON_PRETTY_PRINT);
            exit;
        }
        $id = null;
        $id_origen = $origen;
        $fecha = fecha_mysql;
        $hora = hora_mysql;
        $empresa = mb_strtolower($_POST['empresa']);
        $correo_principal = mb_strtolower($_POST['correo_principal']);
        $datos_correo_generado = $this->GenerarCorreo($correo_principal);
        $correo_secundario = mb_strtolower($datos_correo_generado['correo']);
        $telefono = $_POST['telefono'];
        $id_ubigeo = empty($_POST['id_ubigeo']) ? '' : $_POST['id_ubigeo'];
        $mensaje = empty($_POST['mensaje']) ? '' : mb_strtolower($_POST['mensaje']);
        $observacion = empty($_POST['observacion']) ? '' : mb_strtolower($_POST['observacion']);
        $id_usuario_asignado = empty($_POST['id_usuario_asignado']) ? null : $_POST['id_usuario_asignado'];
        $id_empresa = Session::getValue('EMPRESA' . NOMBRE_SESSION);
        $calificacion = 0;
        try {
            $cliente = new Clientes($id, $id_origen, $fecha, $hora, $empresa, $correo_principal, $correo_secundario, $telefono, $id_ubigeo, $mensaje, $observacion, $id_usuario_asignado, $id_empresa, $calificacion);
            $cliente->create();
            array_push($data, array(
                'respuesta' => '0',
                'respuesta_generar_correo' => $datos_correo_generado,
            ));
        } catch (Exception $ex) {
            array_push($data, array(
                'respuesta' => $e->getMessage(),
                'respuesta_generar_correo' => $datos_correo_generado,
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
        //Correos_controller::EmailBienvenida($email, $empresa);*/
    }

    public function ContadorMostrar() {
        $data = array(
            'id_empresa' => Session::getValue('EMPRESA' . NOMBRE_SESSION),
        );
        $clientes = Clientes::whereVNull($data, 'and', 'id_usuario_asignado');
        $datos = array();
        $i = 0;
        foreach ($clientes as $value) {
            $i++;
        }
        array_push($datos, array('numero_clientes' => $i));
        echo json_encode($datos, JSON_PRETTY_PRINT);
    }

    public function Mostrar() {
        $data = array(
            'id_empresa' => Session::getValue('EMPRESA' . NOMBRE_SESSION),
        );
        $clientes = Clientes::whereVNull($data, 'and', 'id_usuario_asignado');
        $datos = array();
        $i = 0;
        foreach ($clientes as $value) {
            $i++;
            $ubigeo = Ubigeo_controller::ubigeo_completo($value['id_ubigeo']);
            $origen = Origen::getById($value['id_origen']);
            array_push($datos, array(
                'contador' => $i,
                'id' => $value['id'],
                'id_origen' => $origen->getNombre(),
                'fecha' => $value['fecha'],
                'hora' => $value['hora'],
                'empresa' => $value['empresa'],
                'departamento' => $ubigeo['departamento'],
                'provincia' => $ubigeo['provincia'],
                'distrito' => $ubigeo['distrito'],
                'mensaje' => $value['mensaje'],
                'observacion' => $value['observacion'],
                
            ));
        }
        echo json_encode($datos, JSON_PRETTY_PRINT);
    }

    public function AceptarCliente($id) {
        $cliente = Clientes::getById($id);
        $cliente->setId_usuario_asignado(Session::getValue('ID' . NOMBRE_SESSION));
        $cliente->update();
    }

    public function GenerarCorreo($correo_principal) {
        $correo_principal = explode("@", $correo_principal);
        $correo = trim($correo_principal[0]);
        $correo = Hash::create(ALGORITMO_CORREO, $correo, HASHKEY);
        return Cpanel::Crear($correo, "kassandra@2015");
    }

}
