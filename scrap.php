<?php

function getImage($url, $path) {
    $ch = curl_init($url);
    $fp = fopen($path, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}

$baseMetroUrl = "https://www.ratp.fr/sites/default/files/network/metro/";
$metroImage = "https://www.ratp.fr/sites/default/files/network/metro/symbole.svg";

$baseRERUrl = "https://www.ratp.fr/sites/default/files/network/rer/";
$RERImage = "https://www.ratp.fr/sites/default/files/network/rer/symbole.svg";

$baseTramUrl = "https://www.ratp.fr/sites/default/files/network/tram/";
$tramImage = "https://www.ratp.fr/sites/default/files/network/tram/symbole.svg";

$baseTransilienUrl = "https://www.transilien.com/tricharte/img/picto/";
$transilienImage = "https://www.transilien.com/tricharte/img/picto/tn-icon-transilien.svg";

// Get Metro images
// getImage($metroImage, './images/ratp/metro.svg');
// for ($i=1; $i < 15; $i++) { 
//     $name = 'ligne'. $i .'.svg';
//     if ($i == 3) {
//         $name = 'ligne'. $i .'b.svg';
//         getImage($baseMetroUrl . $name, './images/ratp/metro/' . $name);
//         continue;
//     }
//     if ($i == 7) {
//         $name = 'ligne'. $i .'b.svg';
//         getImage($baseMetroUrl . $name, './images/ratp/metro/' . $name);
//         continue;
//     }
//     getImage($baseMetroUrl . $name, './images/ratp/metro/' . $name);
// }

// // Get RER images
// $letters = range('A', 'E');
// getImage($RERImage, './images/ratp/rer.svg');
// foreach ($letters as $letter) {
//     $name = 'ligne'. $letter .'.svg';
//     getImage($baseRERUrl . $name, './images/ratp/rer/' . $name);
// }

// // Get Tram images
// getImage($tramImage, './images/ratp/tram.svg');
// for ($i=1; $i < 9; $i++) {
//     if ($i == 3) {
//         $name = 'ligne'. '3a' .'.svg';
//         getImage($baseTramUrl . $name, './images/ratp/tram/' . $name);
//         $name = 'ligne'. '3b' .'.svg';
//         getImage($baseTramUrl . $name, './images/ratp/tram/' . $name);
//         continue;
//     }
//     $name = 'ligne'. $i .'.svg';
//     getImage($baseTramUrl . $name, './images/ratp/tram/' . $name);
// }

getImage($transilienImage, './images/ratp/transilien.svg');
$letters = ['h', 'j', 'k', 'l', 'n', 'p', 'u'];
foreach ($letters as $letter) {
    $name = 'tn-icon-tra' . $letter . '.svg';
    getImage($baseTransilienUrl . $name, './images/ratp/transilien/' . $name);
}