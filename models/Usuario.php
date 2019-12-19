<?php

class Usuario extends Model {

    protected static $table = "t_usuarios";
    private $id;
    private $id_empresa;
    private $nombres;
    private $apellidos;
    private $correo;
    private $telefono;
    private $celular;
    private $dni;
    private $fechaalta;
    private $usuario;
    private $password;
    private $acceso;
    private $estado;

    function __construct($id, $id_empresa, $nombres, $apellidos, $correo, $telefono, $celular, $dni, $fechaalta, $usuario, $password, $acceso, $estado) {
        $this->id = $id;
        $this->id_empresa = $id_empresa;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->celular = $celular;
        $this->dni = $dni;
        $this->fechaalta = $fechaalta;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->acceso = $acceso;
        $this->estado = $estado;
    }

    function getId() {
        return $this->id;
    }

    function getId_empresa() {
        return $this->id_empresa;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getCorreo() {
        return $this->correo;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCelular() {
        return $this->celular;
    }

    function getDni() {
        return $this->dni;
    }

    function getFechaalta() {
        return $this->fechaalta;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getAcceso() {
        return $this->acceso;
    }

    function getEstado() {
        return $this->estado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCelular($celular) {
        $this->celular = $celular;
    }

    function setDni($dni) {
        $this->dni = $dni;
    }

    function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setAcceso($acceso) {
        $this->acceso = $acceso;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }

}
