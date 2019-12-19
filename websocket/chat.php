<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require 'vendor/autoload.php';

class MyChat implements MessageComponentInterface {

    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);   
        var_dump(count($this->clients));
        echo "New connection! ({$conn->resourceId})\n";
         $this->enviarmensaje('se conecto alguien');
        //$this->enviarmensaje('se deconecto alguien');
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $this->enviarmensaje($msg);
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        $this->enviarmensaje('se deconecto alguien');
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    public function enviarmensaje($mensaje) {
        foreach ($this->clients as $client) {
            $client->send($mensaje);
        }
    }

}

$app = new Ratchet\App('192.168.1.3', 8080,'0.0.0.0');
$app->route('/chat', new MyChat, array(
    '*'
));
$app->route('/echo', new Ratchet\Server\EchoServer, array(
    '*'
));
$app->run();
