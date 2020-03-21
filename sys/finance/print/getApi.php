<?php
//$curlHandler = curl_init();
echo '555'; 
exit();

$userName = 'admin';
$password = 'Topcooling482';

curl_setopt_array($curlHandler, [
    CURLOPT_URL => 'http://80.211.47.159:18083/api/v3/connections/',  //http://80.211.47.159:18083/api/v3/connections
    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_USERPWD => $userName . ':' . $password,
]);

$response = curl_exec($curlHandler);
curl_close($curlHandler);

print_r('First example response: ' . $response . PHP_EOL);



$curlSecondHandler = curl_init();

curl_setopt_array($curlSecondHandler, [
    CURLOPT_URL => 'http://80.211.47.159:18083/api/v3/connections/',
    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_HTTPHEADER => [
        'Authorization: Basic ' . base64_encode($userName . ':' . $password)
    ],
]);

$response = curl_exec($curlSecondHandler);
curl_close($curlSecondHandler);

print_r('Second example response: ' . $response . PHP_EOL);
