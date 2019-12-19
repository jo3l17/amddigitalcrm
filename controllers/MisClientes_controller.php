<?php

class MisClientes_controller extends Controller {

    public function Mostrar() {
        Verificacion_controller::Cabeceras();
        $data = array(
            'id_usuario_asignado' => Session::getValue('ID' . NOMBRE_SESSION),
            'id_empresa' => Session::getValue('EMPRESA' . NOMBRE_SESSION),
        );
        $clientes = Clientes::whereV($data, 'and');
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
                'id_usuario_asignado' => $value['id_usuario_asignado'],
                'observacion' => $value['observacion'],
                'calificacion' => $value['calificacion'],
            ));
        }
        echo json_encode($datos, JSON_PRETTY_PRINT);
    }

    public function MandarMensaje() {
        $cliente = Clientes::getById($_POST['cliente_id']);
        $usuario = Usuario::getById($_POST['usario_id']);
        $id = null;
        $id_cliente = $_POST['cliente_id'];
        $tipo = 'S';
        $mensaje = $_POST['cuerpo'];
        $fecha = fecha_mysql;
        $hora = hora_mysql;
        $id_usuario = Session::getValue('ID' . NOMBRE_SESSION);
        $revisado = 1;
        $clientes_correo = new ClientesCorreo($id, $id_cliente, $tipo, $mensaje, $fecha, $hora, $id_usuario, $revisado);
        $clientes_correo->create();

        Correos_controller::CorreoMisClientes($cliente->getCorreo_secundario(), $cliente->getCorreo_principal(), $cliente->getEmpresa(), $_POST['cuerpo'], $usuario->getCorreo(), $usuario->getNombres() . ' ' . $usuario->getApellidos(), 'C', $_POST['asunto']);
        Correos_controller::CorreoMisClientes($cliente->getCorreo_secundario(), $cliente->getCorreo_principal(), $cliente->getEmpresa(), $_POST['cuerpo'], $usuario->getCorreo(), $usuario->getNombres() . ' ' . $usuario->getApellidos(), 'V', $_POST['asunto']);
    }

    public function ejemplo() {
        $id_cliente = 1;
        $cliente = Clientes::getById($id_cliente);
       // print_r($cliente);
        $var = new mail_reader("{mail.hardmachineaqp.com:993/imap/ssl}INBOX", $cliente->getCorreo_secundario(), HASHKEY);
        $var->AllMessagesCondition($id_cliente);
    }

    public function CambiarCalificacion() {
        $clientes = Clientes::getById($_POST['id']);
        $clientes->setCalificacion($_POST['calificacion']);
        $clientes->update();
    }

}
