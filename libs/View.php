    <?php

class View {

    function render($controller, $view, $title = ' ', $archivo = ' ') {
        $controller = get_class($controller);
        $controller = substr($controller, 0, -11);
        $path = './views/' . $controller . '/' . $view;
        if (file_exists($path . '.php')) {
            if ($title != "") {
                $this->title = $title;
            }
            if ($archivo != "") {
                $this->archivo = $archivo;
            }
            require URLINC . 'head.php';
            require URLINC . 'body_initial.php';
            require $path . '.php';
            require URLINC . 'footer.php';
        } elseif (file_exists($path . '.html')) {
            if ($title != "") {
                $this->title = $title;
            }
            if ($archivo != "") {
                $this->archivo = $archivo;
            }
            require URLINC . 'head.php';
            require URLINC . 'body_initial.php';
            require $path . '.html';
            require URLINC . 'footer.php';
        } else {
            echo 'Error : Invalida Vista <strong>' . $view . '</strong> para renderizar';
        }
    }

}
