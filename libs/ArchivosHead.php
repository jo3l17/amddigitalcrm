<?php

class ArchivosHead {

    public function ListarFw($ruta, $archivo, $fw = '') {
        if ($fw) {
            $directorio = $ruta;
        } else {
            $directorio = URLFW . $ruta;
        }
        $extension = explode('.', $archivo);
        $count = count($extension);
        switch ($extension[$count - 1]) {
            case 'css':
                $link = '<link rel="stylesheet" href="' . URL . $directorio . '/' . $archivo . '">';
                break;
            case 'js':
                $link = '<script type="text/javascript" src="' . URL . $directorio . '/' . $archivo . '"></script>';
                break;
        }
        echo $link;
    }

    public function ListarCarpetas($tipo_archivo) {
        switch ($tipo_archivo) {
            case 'css':
                $directorio = opendir(URLCSSSYSTEM);
                break;
            case 'js':
                $directorio = opendir(URLJSSYSTEM);
                break;
        }
        while ($archivo = readdir($directorio)) {
            if (!is_dir($archivo)) {
                if ($archivo == true) {
                    switch ($tipo_archivo) {
                        case 'css':
                            $link = '<link rel="stylesheet" href="' . URL . URLCSSSYSTEM . $archivo . '">';
                            break;
                        case 'js':
                            $link = '<script type="text/javascript" src="' . URL . URLJSSYSTEM . $archivo . '"></script>';
                            break;
                    }
                    echo $link;
                }
            }
        }
    }

}
