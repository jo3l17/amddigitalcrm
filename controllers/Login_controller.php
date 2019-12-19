<?php

class Login_controller extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function Login()
    {
        $usu_usuario = $_POST['usuario'];
        $usu_password = Hash::create(ALGORITMO, $_POST['password'], HASHKEY);
        $condicion_usuario = Usuario::where('usuario', $usu_usuario);
        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            if (empty($_POST['usuario'])) {
                echo 0.1; //usuario vacio
                exit;
            }
            if (empty($_POST['password'])) {
                echo 0.2; //password vacio
                exit;
            }
        } else {
            if (empty($condicion_usuario)) {
                echo 0; //'no existe usuario';
                exit;
            } else {
                foreach ($condicion_usuario as $value) {
                    $id = $value['id'];
                    $empresa = $value['id_empresa'];
                    $password = $value['password'];
                }
                if ($usu_password == $password) {
                    echo 1; //'coincide y estamos adentro';
                    $this->crearsesion($id, $empresa);
                } else {
                    echo 2; //'existe usuario pero no coincide contraseña';
                }
            }
        }
    }

    function crearsesion($id_usuario, $id_empresa)
    {
        Session::setValue('ID' . NOMBRE_SESSION, $id_usuario);
        Session::setValue('EMPRESA' . NOMBRE_SESSION, $id_empresa);
    }

    function destroy_session()
    {
        Session::destroy();
        echo '<script>';
        echo 'document.location = "' . URL . '";';
        echo '</script>';
    }

    function ejemplo()
    {
        echo $_POST['usuario'] . ' su contraseña es : ' . $_POST['password'];
    }
}
