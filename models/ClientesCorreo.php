<?php

class ClientesCorreo extends Model {

    protected static $table = "t_clientescorreo";
    private $id;
    private $id_cliente;
    private $tipo;
    private $mensaje;
    private $fecha;
    private $hora;
    private $id_usuario;
    private $revisado;

    function __construct($id, $id_cliente, $tipo, $mensaje, $fecha, $hora, $id_usuario, $revisado) {
        $this->id = $id;
        $this->id_cliente = $id_cliente;
        $this->tipo = $tipo;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->id_usuario = $id_usuario;
        $this->revisado = $revisado;
    }

    function getId() {
        return $this->id;
    }

    function getId_cliente() {
        return $this->id_cliente;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getMensaje() {
        return $this->mensaje;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getId_usuario() {
        return $this->id_usuario;
    }

    function getRevisado() {
        return $this->revisado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_cliente($id_cliente) {
        $this->id_cliente = $id_cliente;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setMensaje($mensaje) {
        $this->mensaje = $mensaje;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    function setRevisado($revisado) {
        $this->revisado = $revisado;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }

}
