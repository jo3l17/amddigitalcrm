<?php

class Upload_controller extends Controller {

    public function upload_imagen() {
        mkdir(URLIMG . "imagenesweb/", 0777);
        $output_dir = URLIMG . "imagenesweb/";
        if (isset($_FILES["imagen"])) {
            $ret = array();
            $error = $_FILES["imagen"]["error"];
            if (!is_array($_FILES["imagen"]["name"])) {
                $fileName = $_FILES["imagen"]["name"];
                $nombre_archivo = explode('.', $fileName);
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $output_dir . 'logo_' . $nombre_archivo[0] . '.' . $nombre_archivo[1]);
                $ret[] = $fileName;
            } else {
                $fileCount = count($_FILES["imagen"]["name"]);
                for ($i = 0; $i < $fileCount; $i++) {
                    $fileName = $_FILES["imagen"]["name"][$i];
                    move_uploaded_file($_FILES["imagen"]["tmp_name"][$i], $output_dir . $fileName);
                    $ret[] = $fileName;
                }
            }
            echo json_encode($ret);
            
        }
    }

}
