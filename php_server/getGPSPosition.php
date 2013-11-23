<?php

require 'jsonwrapper/jsonwrapper.php';
include('./include/config.php');
include('./include/dbaccess.php');

$gps = getGPS();

echo $gps;

/*$bus = array(
    'lat' => end($gps)[1],
    'lon' => end($gps)[2],
);*/



$jsonstring = json_encode($bus);
echo $jsonstring;


?>