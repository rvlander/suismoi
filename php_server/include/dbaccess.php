<?php
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	//mailing liste
	$get_GPS_request = $db->prepare('SELECT * FROM suismoi');
	//$select_politicien = $db->prepare('SELECT * FROM Politiciens WHERE id = ?');
	//$count_politiciens = $db->prepare('SELECT COUNT(*) FROM Politiciens');
	//$update_elo = $db->prepare('UPDATE Politiciens SET elo_points=? WHERE id=?');

        //contenu
       /* $get_content_request = $db->prepare('SELECT content FROM content WHERE name = ?');
        $get_editables_request = $db->prepare('SELECT name FROM content');
        $update_content_request = $db->prepare('UPDATE content SET content=? WHERE name=?');

	//lor de la creation d'un match
	/*$insert_match = $db->prepare('INSERT INTO Matches (match_id,opponent1,opponent2) VALUES (?,?,?)');
	$select_match = $db->prepare('SELECT * FROM Matches WHERE match_id = ?');
	$delete_match = $db->prepare('DELETE FROM Matches WHERE match_id = ?');*/

	//insertion d'un vote
	//$insert_mail_request = $db->prepare('INSERT INTO mailing (mail) VALUES(?)');
	//$count_votes =  $db->prepare('SELECT COUNT(*) FROM Votes');


	//retourne la liste des politiciens 
	function getGPS(){
		global $get_GPS_request;
		$get_GPS_request->execute();
		$gps_coords = $get_mails_request->fetchAll();
		return $gps_coords;
	}

        /*function insertMail($mail){
		global $insert_mail_request;
		//echo $result;
		$res =$insert_mail_request->execute(array($mail));
		//$db->commit();
		return $res;
	}

        function getContent($name){
		global $get_content_request;
		$get_content_request->execute(array($name));
		$res = $get_content_request->fetchAll();
		return $res[0][0];
	}
        function getEditables(){
		global $get_editables_request;
		$get_editables_request->execute();
		$editables = $get_editables_request->fetchAll();
                $res= array();
                foreach($editables as $edit){
                    array_push($res, $edit[0]);
                }
		return $res;
	}

        function updateContent($name,$content){
		global $update_content_request;
		$res = $update_content_request->execute(array($content,$name));
		return $res;
	}*/

?>