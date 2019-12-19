<?php

class Usuario_controller extends Controller {

    public function MostrarUsuarios() {
        $datos = array(
            'id_empresa' => Session::getValue('EMPRESA' . NOMBRE_SESSION),
        );
        $data = array();
        $usuarios = Usuario::whereV($datos, 'and');
         foreach ($usuarios as $value) {
            array_push($data, array(
                'id' => $value['id'],
                'usuario' => ucfirst($value['usuario']),
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}
