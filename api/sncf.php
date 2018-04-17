<?php
header("Access-Control-Allow-Origin: *");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.sncf.com/api/iv/1.0/avance/rechercherPrevisions",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: a2d33dd2-1a43-bae8-b459-a887cc6c4d3b"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  header("Content-type:application/json");
  echo "{error: $err}";
} else {
  header("Content-type:application/json");
  echo $response;
}