<?php

include('./include/config.php');
include('./include/dbaccess.php');

$identifiant = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_STRING);

if($identifiant){
    $gps = getGPS($identifiant);

    $jsonstring = json_encode(end($gps));
    echo $jsonstring;
}


?>