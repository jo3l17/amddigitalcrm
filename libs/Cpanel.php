<?php

require URLFW . 'xmlapi/xmlapi.php';

class Cpanel {

    public function Crear($email, $password, $action = '') {
        $ip = '142.44.199.21';
        $account = "hardmachine";
        $domain = "hardmachineaqp.com";
        $account_pass = "kassandra@2015";
        $xmlapi = new xmlapi($ip);
        $xmlapi->password_auth($account, $account_pass);
        $xmlapi->set_output('json');
        $xmlapi->set_port('2083');
        $xmlapi->set_debug(1);
        if ($action == '') {
            $results = json_decode($xmlapi->api2_query("serverusername", "Email", "addpop", array('domain' => $domain, 'email' => $email, 'password' => $password, 'quota' => 'Unlimited')), true);
        } else {
            $results = json_decode($xmlapi->api2_query("serverusername", "Email", "delpop", array('domain' => $domain, 'email' => $email, 'password' => $password, 'quota' => 'Unlimited')), true);
        }

        $data = array(
            'resultado_correo' => $results['cpanelresult']['data'][0]['result'],
            'resultado_reason' => empty($results['cpanelresult']['data'][0]['reason']) ? "creado correctamente" : $results['cpanelresult']['data'][0]['reason'],
            'correo' => $email . '@' . $domain,
        );
        return $data;
    }

}
