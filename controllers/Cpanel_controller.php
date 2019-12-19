<?php

class Cpanel_controller extends Controller {

    function __construct() {
        parent::__construct();
    }

  

    public function Pagina($pagina = '') {       
        if (empty($pagina)) {
            $this->view->render($this, 'panel_cliente', NOMBRE_EMPRESA, 'panel_cliente');
        } else {
            $this->view->render($this, $pagina, NOMBRE_EMPRESA, $pagina);
        }
    }

}
