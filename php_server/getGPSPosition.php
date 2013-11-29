<?php

include('./include/config.php');
include('./include/dbaccess.php');

$gps = getGPS('bastien');

$jsonstring = json_encode($gps);
echo $jsonstring;


?>