<?php

class mail_reader {

    private $connect_to;
    private $connection;
    private $user;
    private $password;
    private $emails;
    private $unseen;

    public function __construct($connect_to, $user, $password) {
        $this->connect_to = $connect_to;
        $this->user = $user;
        $this->password = $password;
        $this->connection = imap_open($connect_to, $user, $password) or die("Can't connect to '$connect_to': " . imap_last_error());
        $this->emails = imap_search($this->connection, 'ALL');
        $this->unseen = imap_search($this->connection, 'UNSEEN');
        rsort($this->emails);
    }

    public function head($variable) {
        $check = imap_mailboxmsginfo($this->connection);
        $dato['fecha'] = $check->Date;
        $dato['mensajes'] = $check->Nmsgs;
        $dato['sinleer'] = $check->Unread;
        $dato['recientes'] = $check->Recent;
        $dato['eliminados'] = $check->Deleted;
        $dato['tamano_buzon'] = $check->Size;
        return $dato[$variable];
    }

    public function AllMessages() {
        $checar = imap_check($this->connection);
        $resultados = imap_fetch_overview($this->connection, "1:{$checar->Nmsgs}", 0);
        krsort($resultados);
        foreach ($resultados as $detalles) {
            $detalles->msgno;
            $detalles->from;
            $detalles->subject;
            $detalles->size;
            $detalles->date;
            $detalles->seen;
        }
    }

    public function AllMessagesCondition($id_cliente) {
        $cliente = Clientes::getById($id_cliente);
        $usuario = Usuario::getById($cliente->getId_usuario_asignado());
        $checar = imap_check($this->connection);
        $resultados = imap_fetch_overview($this->connection, "1:{$checar->Nmsgs}", 0);
        krsort($resultados);
        $date_format = "Y-m-d H:i:s";
        $header = imap_header($this->connection, 1);
        $date = date($date_format, $header->udate);
        $date = explode(" ", $date);
        foreach ($resultados as $detalles) {
            $remitente_ = imap_rfc822_parse_adrlist($detalles->from, '');
            $remitente = $remitente_[0]->mailbox . '@' . $remitente_[0]->host;
            if ($detalles->seen == "0" && $remitente != 'crm@hardmachineaqp.com' && $remitente != $usuario->getCorreo()) {
                $id = null;
                $id_cliente = $id_cliente;
                $tipo = 'C';
                $mensaje = $this->message($detalles->msgno);
                $fecha = $date[0];
                $hora = $date[1];
                $id_usuario = $cliente->getId_usuario_asignado();
                $revisado = 0;
                $clientes_correo = new ClientesCorreo($id, $id_cliente, $tipo, $mensaje, $fecha, $hora, $id_usuario, $revisado);
                $clientes_correo->create();
                $status = imap_setflag_full($this->connection, $detalles->msgno, "\\Seen \\Flagged", ST_UID);
                Correos_controller::CorreoMisClientes($cliente->getCorreo_secundario(), $cliente->getCorreo_principal(), $cliente->getEmpresa(), $mensaje, $usuario->getCorreo(), $usuario->getNombres() . ' ' . $usuario->getApellidos(), 'V','');
            }
             if ($detalles->seen == "0" && $remitente == $usuario->getCorreo()) {
                $id = null;
                $id_cliente = $id_cliente;
                $tipo = 'V';
                $mensaje = $this->message($detalles->msgno);
                $fecha = $date[0];
                $hora = $date[1];
                $id_usuario = $cliente->getId_usuario_asignado();
                $revisado = 1;
                $clientes_correo = new ClientesCorreo($id, $id_cliente, $tipo, $mensaje, $fecha, $hora, $id_usuario, $revisado);
                $clientes_correo->create();
                $status = imap_setflag_full($this->connection, $detalles->msgno, "\\Seen \\Flagged", ST_UID);
                Correos_controller::CorreoMisClientes($cliente->getCorreo_secundario(), $cliente->getCorreo_principal(), $cliente->getEmpresa(), $mensaje, $usuario->getCorreo(), $usuario->getNombres() . ' ' . $usuario->getApellidos(), 'C','');
            }
        }
    }

    public function email($number) {
        $email = imap_fetch_overview($this->connection, $number, 0);
        return $email[0];
    }

    public function message($number) {
        $info = imap_fetchstructure($this->connection, $number, 0);
        if ($info->encoding == 3) {
            $message = base64_decode(imap_fetchbody($this->connection, $number, 1));
        } elseif ($info->encoding == 4) {
            $message = imap_qprint(imap_fetchbody($this->connection, $number, 1));
        } else {
            $message = imap_fetchbody($this->connection, $number, 1);
        }
        $resultado = $this->correccion_cadena($this->decode_qprint($message));
        $resultado = explode("\r\n", $resultado);
        return ($resultado[0]);
    }

    public function __destruct() {
        imap_close($this->connection);
    }

    public function __get($var) {
        $temp = strtolower($var);
        if (property_exists('mail_reader', $temp)) {
            return $this->$temp;
        }
        return NULL;
    }

    function decode_qprint($str) {
        $str = preg_replace("/\=([A-F][A-F0-9])/", "%$1", $str);
        $str = urldecode($str);
        $str = utf8_encode($str);
        return $str;
    }

    function correccion_cadena($rb) {
        $rb = str_replace("Ã¡", "&aacute;", $rb);
        $rb = str_replace("Ã©", "&eacute;", $rb);
        $rb = str_replace("Â®", "&reg;", $rb);
        $rb = str_replace("Ã­", "&iacute;", $rb);
        $rb = str_replace("ï¿½", "&iacute;", $rb);
        $rb = str_replace("Ã³", "&oacute;", $rb);
        $rb = str_replace("Ãº", "&uacute;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Âº", "&ordm;", $rb);
        $rb = str_replace("Âª", "&ordf;", $rb);
        $rb = str_replace("ÃƒÂ¡", "&aacute;", $rb);
        $rb = str_replace("Ã±", "&ntilde;", $rb);
        $rb = str_replace("Ã‘", "&Ntilde;", $rb);
        $rb = str_replace("ÃƒÂ±", "&ntilde;", $rb);
        $rb = str_replace("n~", "&ntilde;", $rb);
        $rb = str_replace("Ãš", "&Uacute;", $rb);
        return $rb;
    }

}
