<?php
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	$get_GPS_request = $db->prepare('SELECT T.latitude,T.longitude FROM users E, suismoi T WHERE E.identifiant=?');
        $get_user_id_request = $db->prepare('SELECT id FROM users WHERE identifiant=? AND passphrase=?');
	$insert_position = $db->prepare('INSERT INTO suismoi (user,date,latitude,longitude) VALUES (?,NOW(),?,?)');

	function getGPS($identifiant){
		global $get_GPS_request;
		$get_GPS_request->execute(array($identifiant));
		$gps_coords = $get_GPS_request->fetchAll();
		return $gps_coords;
	}
        
        function getUserId($identifiant,$password){
		global $get_user_id_request;
		$get_user_id_request->execute(array($identifiant,$password));
		$user = $get_user_id_request->fetchAll();
		return $user;
	}

        function insertPosition($uid,$latitude,$longitude){
		global $insert_position;
		$res =$insert_position->execute(array($uid,$latitude,$longitude));
		return $res;
	}

?>
