<?php

class Ejemplo_controller extends Controller {

    public function ejemplo() {
        $data = [
            'phone' => '+51933679918', // Receivers phone
            'body' => 'Hola Joel!', // Message
        ];
        $json = json_encode($data); // Encode data to JSON
// URL for request POST /message
        $url = 'https://eu8.chat-api.com/instance78781/message?token=ykgohskv6i3uq912';

// Make a POST request
        $options = stream_context_create(['http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
// Send a request
        $result = file_get_contents($url, false, $options);
        print_r($result);
    }

    public function ejemplo1() {
        $numero = '51933679918';
        //$numero = '51933679918';
        $url = 'https://eu8.chat-api.com/instance78781/messages?token=ykgohskv6i3uq912&chatId=' . $numero . '@c.us&lastMessageNumber=199';
        $result = file_get_contents($url); // Send a request


        $data = json_decode($result, 1); // Parse JSON

        foreach ($data['messages'] as $message) { // Echo every message
            /* echo "Message: " . $message['messageNumber'] . "<br>";
              echo '<hr>'; */
            if ($message['author'] == $numero . '@c.us' && $message['chatId'] == $numero . '@c.us') {
                echo "Sender:" . $message['author'] . "<br>";
                echo "Message: " . $message['body'] . "<br>";
                echo "Message: " . $message['chatId'] . "<br>";
                echo '<hr>';
            }
        }
    }
      public function ejemplo2() {
        $data = [
            
            'webhookUrl' => 'https://us-central1-app-chat-api-com.cloudfunctions.net/botsConstructorWebhook?uid=vNR409pzU2MYeQACtV154j87Nxp1&instanceId=78781', // Message
        ];
        $json = json_encode($data); // Encode data to JSON
// URL for request POST /message
        $url = 'https://eu8.chat-api.com/instance78781/{https://us-central1-app-chat-api-com.cloudfunctions.net/botsConstructorWebhook?uid=vNR409pzU2MYeQACtV154j87Nxp1&instanceId=78781}:messages?token=ykgohskv6i3uq912';

// Make a POST request
        $options = stream_context_create(['http' => [
                'method' => 'POST',
                'header' => 'Content-type: application/json',
                'content' => $json
            ]
        ]);
// Send a request
        $result = file_get_contents($url, false, $options);
        print_r($result);
    }
    public function ejemplo5(){
        Verificacion_controller::Cabeceras();
        $clientes = Clientes::getAll();
        $numero = count($clientes);
        $data=array(
            'numero'=>$numero,
        );
        echo json_encode($data,JSON_PRETTY_PRINT);
    }

}
