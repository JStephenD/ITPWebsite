<?php
class Utils {
    function render($path) {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    function find_file($path) {
        while (false == file_exists($path)) {
            $path = '../' . $path;
        }
        return $path;
    }

    function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    function login_required($redirect_url='/user/login') {
        if (!isset($_SESSION['user'])) {
            Messages::add(
                "Must be <strong>logged in</strong> to use the system.",
                "warning"
            );
            header('Location: ' . $redirect_url);
        }
    }

    function getIp() {
        $ipadd = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipadd = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipadd = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipadd = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipadd = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipadd = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipadd = $_SERVER['REMOTE_ADDR'];
        else
            $ipadd = 'UNKNOWN';
        return $ipadd;
    }

    function getPublicIp() {
        $ipadd = file_get_contents("http://ipecho.net/plain");
        return $ipadd;
    }

    function getIpData($ipadd) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ipdata.co/" . $ipadd . "?api-key=" . $_ENV['ipdata'],
            // CURLOPT_URL => "https://signals.api.auth0.com/v2.0/ip/" . $ipadd,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                // "x-auth-token: " . $_ENV['auth0']
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "error";
        } else {
            return $response;
        }
    }

    function getLocation($ipadd) {
        $ipdataurl = $_SERVER['DOCUMENT_ROOT'] . '/assets/json/ipdata.json';

        // check if ip data is saved/cached
        $ipdata_str = file_get_contents($ipdataurl);
        $json = json_decode($ipdata_str, true);
        foreach ($json['locations'] as $location) {
            if ($ipadd == $location['ip']) {
                return [$location['latitude'], $location['longitude']];
            }
        }

        $ipdata = $this->getIpData($ipadd);
        $ipdata_json = json_decode($ipdata, true);
        array_push($json['locations'], [
            "ip" => $ipdata_json['ip'],
            "latitude" => $ipdata_json['latitude'],
            "longitude" => $ipdata_json['longitude']
        ]);

        $ipdatafile = fopen($ipdataurl, 'w');
        fwrite($ipdatafile, json_encode($json));
        fclose($ipdatafile);
        
        $loc = [$ipdata_json['latitude'], $ipdata_json['longitude']];
        return $loc;
    }   
}
