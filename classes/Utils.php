<?php
class Utils {
    function __construct() {
        $this->perms_ref = $this->getPermsRef();
    }

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

            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                $response = [
                    'status' => 550,
                    'statusText' => 'Permission denied',
                    'response' => [
                        'redirect_url' => $redirect_url
                    ]
                ];
                echo json_encode($response);
                exit;
            } else {
                header('Location: ' . $redirect_url);
                exit;
            }
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
        require_once '../vendor/autoload.php';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/.env')) {
            $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'], '/.env');
            $dotenv->load();
        }
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
        var_dump($_ENV);
        var_dump(getenv('ipdata'));
        var_dump($response);

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

    function getPermsRef() {
        return [
            'admin'                 => 0x0000000001,

            'citymun_listing'       => 0x0000000010,
            'citymun_add'           => 0x0000000020,
            'citymun_edit'          => 0x0000000040,
            'citymun_delete'        => 0x0000000080,

            'brgy_listing'          => 0x0000000100,
            'brgy_add'              => 0x0000000200,
            'brgy_edit'             => 0x0000000400,
            'brgy_delete'           => 0x0000000400,

            'mapping_citymun'       => 0x0000001000,

            'user_account'          => 0x0000010000,
        ];
    }

    function getPermsValue(array $selected_perms) {
        $perms = 0x0;
        $perms_ref = $this->perms_ref;

        foreach ($selected_perms as $perm) {
            $perms = $perms_ref[$perm] | $perms;
        }

        return $perms;
    }

    function getPermsAsList(string $perms) {
        $perms = intval($perms);

        $rv = [];

        if ($perms == 0) {
            return [];
        }

        foreach ($this->perms_ref as $perm_name => $perm_val) {
            if (($perms & $perm_val) == $perm_val && $perm_val != 0) {
                array_push($rv, $perm_name);
            }
        }

        return $rv;
    }

    function checkPermission(string $perms, string $to_check) {
        $perms = intval($perms);
        $perms_ref = $this->perms_ref;

        $perm = $perms_ref[$to_check];
        return (($perms & $perm) == $perm);
    }

    function permsRequired(string $perms, array $required_perms, $redirect_url = '/user/account') {
        $perms = intval($perms);
        $perms_ref = $this->perms_ref;
        $valid = true;

        foreach ($required_perms as $req_perm) {
            if (($perms & $perms_ref[$req_perm]) == $perms_ref[$req_perm]) {
                continue;
            } else {
                $valid = false;
                Messages::add(
                    "Must have <strong>" . $req_perm . "</strong> permission to access the module.<br>
                    Message your server admin for permission request.",
                    "warning"
                );
            }
        }

        if (!$valid) {
            if (isset($_POST['ajax'])) {
                header('Content-Type: application/json');
                $response = [
                    'status' => 550,
                    'statusText' => 'Permission denied',
                    'response' => [
                        'redirect_url' => $redirect_url
                    ]
                ];
                echo json_encode($response);
                exit;
            } else {
                header('Location: ' . $redirect_url);
                exit;
            }
        }
    }
}
