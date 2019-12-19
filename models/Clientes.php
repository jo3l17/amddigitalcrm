<?php

class Clientes extends Model {

    protected static $table = "t_clientes";
    private $id;
    private $id_origen;
    private $fecha;
    private $hora;
    private $empresa;
    private $correo_principal;
    private $correo_secundario;
    private $telefono;
    private $id_ubigeo;
    private $mensaje;
    private $observacion;
    private $id_usuario_asignado;
    private $id_empresa;
    private $calificacion;

    function __construct($id, $id_origen, $fecha, $hora, $empresa, $correo_principal, $correo_secundario, $telefono, $id_ubigeo, $mensaje, $observacion, $id_usuario_asignado, $id_empresa, $calificacion) {
        $this->id = $id;
        $this->id_origen = $id_origen;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->empresa = $empresa;
        $this->correo_principal = $correo_principal;
        $this->correo_secundario = $correo_secundario;
        $this->telefono = $telefono;
        $this->id_ubigeo = $id_ubigeo;
        $this->mensaje = $mensaje;
        $this->observacion = $observacion;
        $this->id_usuario_asignado = $id_usuario_asignado;
        $this->id_empresa = $id_empresa;
        $this->calificacion = $calificacion;
    }

    function getId() {
        return $this->id;
    }

    function getId_origen() {
        return $this->id_origen;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getEmpresa() {
        return $this->empresa;
    }

    function getCorreo_principal() {
        return $this->correo_principal;
    }

    function getCorreo_secundario() {
        return $this->correo_secundario;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getId_ubigeo() {
        return $this->id_ubigeo;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getObservacion() {
        return $this->observacion;
    }

    function getId_usuario_asignado() {
        return $this->id_usuario_asignado;
    }

    function getId_empresa() {
        return $this->id_empresa;
    }

    function getCalificacion() {
        return $this->calificacion;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_origen($id_origen) {
        $this->id_origen = $id_origen;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    function setCorreo_principal($correo_principal) {
        $this->correo_principal = $correo_principal;
    }

    function setCorreo_secundario($correo_secundario) {
        $this->correo_secundario = $correo_secundario;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setId_ubigeo($id_ubigeo) {
        $this->id_ubigeo = $id_ubigeo;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setObservacion($observacion) {
        $this->observacion = $observacion;
    }

    function setId_usuario_asignado($id_usuario_asignado) {
        $this->id_usuario_asignado = $id_usuario_asignado;
    }

    function setId_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
    }

    function setCalificacion($calificacion) {
        $this->calificacion = $calificacion;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }

}
