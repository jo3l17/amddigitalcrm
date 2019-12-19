<?php

class PanelCliente_controller extends Controller {

   public  function LlamarCorreos($usuario, $cliente) {
        $data = array(
            'id_cliente' => $cliente,            
        );
        $datos = array();
        $clientes_correo = ClientesCorreo::whereV($data, 'and','ORDER BY fecha,hora DESC');
        $i = 0;
        foreach ($clientes_correo as $value) {
            $i++;
            array_push($datos, array(
                'contador'=>$i++,
                'id' => $value['id'],
                'id_cliente' => $value['id_cliente'],
                'tipo' => $value['tipo'],
                'mensaje' => $value['mensaje'],
                'fecha' => $value['fecha'],
                'hora' => $value['hora'],
                'id_usuario' => $value['id_usuario'],
                'revisado' => $value['revisado'],
            ));
        }
        echo json_encode($datos,JSON_PRETTY_PRINT);
    }

}
