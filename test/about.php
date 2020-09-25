<?php

require '../vendor/autoload.php';

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT'], '/.env');
    $dotenv->load();
}

echo '<pre>';
print_r($_ENV);
echo '</pre>';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.ipdata.co/49.148.58.241?api-key=" . $_ENV['ipdata'],
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