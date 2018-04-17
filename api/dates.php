<?php
header("Access-Control-Allow-Origin: *");

header("Content-type:application/json");
$dates = file_get_contents('dates.json');
echo $dates;