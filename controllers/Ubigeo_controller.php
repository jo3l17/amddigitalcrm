<?php

class Ubigeo_controller extends Controller {

    public function __construct() {
        parent::__construct();
    }

    function ubigeo_completo($data) {
        $ubigeo = Ubigeo::getById($data);
        $ubigeo_completo = array(
            'departamento' => $ubigeo->getUbi_departamento(),
            'provincia' => $ubigeo->getUbi_provincia(),
            'distrito' => $ubigeo->getUbi_distrito(),
        );
        return $ubigeo_completo;
    }

    function MostrarUbigeos() {
        $ubigeo = Ubigeo::getAll();
        $data = array();
        foreach ($ubigeo as $value) {
            array_push($data, array(
                'id' => $value['id'],
                'departamento' => ucfirst($value['ubi_departamento']),
                'provincia' => ucfirst($value['ubi_provincia']),
                'distrito' => ucfirst($value['ubi_distrito']),
            ));
        }
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}
