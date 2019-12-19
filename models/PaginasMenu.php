<?php

class PaginasMenu extends Model {

    protected static $table = "t_paginas_menu";
    private $id;
    private $pagina;
    private $usuarios;

    function __construct($id, $pagina, $usuarios) {
        $this->id = $id;
        $this->pagina = $pagina;
        $this->usuarios = $usuarios;
    }

    function getId() {
        return $this->id;
    }

    function getPagina() {
        return $this->pagina;
    }

    function getUsuarios() {
        return $this->usuarios;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPagina($pagina) {
        $this->pagina = $pagina;
    }

    function setUsuarios($usuarios) {
        $this->usuarios = $usuarios;
    }

    public function getMyVars() {
        return get_object_vars($this);
    }

}
