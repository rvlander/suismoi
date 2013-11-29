<?php

include('./include/config.php');
include('./include/dbaccess.php');


$identifiant = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_STRING);
$passphrase = filter_input(INPUT_GET, 'pass' , FILTER_SANITIZE_STRING);
$latidude = filter_input(INPUT_GET, 'lat' , FILTER_VALIDATE_FLOAT);
$longitude = filter_input(INPUT_GET, 'lon' , FILTER_VALIDATE_FLOAT);

echo $identifiant;
echo $passphrase;
echo $latidude;
echo $longitude;

if($identifiant && $passphrase
        && $latidude && $longitude){
    $uidt = getUserId($identifiant,$passphrase);
}

if($uidt){
    $uid = $uidt[0]['id'];
    insertPosition($uid,$latidude,$longitude);
}

?>