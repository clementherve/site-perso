<?php

	//call the database class
	require_once('db.class.php');
	require_once('../conf.php');
	$db = new db();


	//start the session to grab the user information
	session_start();


	//check for password validity
	if( !isset($_SESSION['mdp']) ){
		$data['code'] = 500;
		$data['text'] = 'accès non autorisé';
		die(json_encode($data));
	}
	

	//route the data to the correct place
	if( isset($_POST['action']) ){

		//here, we add an entry to the database
		if($_POST['action'] == 'post-new-message'){

			//sanitize user input
			$valeur = preg_replace("#'#", "\'", htmlentities($_POST['content']));
			$date = date('Y/m/d');
			$heure = date('G:i:s');
			$pseudo = $_SESSION['pseudo'];
			$type = 'message';

			//make the query
			$query = "INSERT INTO message (
				auteur,
				date,
				heure,
				valeur,
				type
				) VALUES (
				'".$pseudo."',
				'".$date."',
				'".$heure."',
				'".$valeur."',
				'".$type."'
				);";
			//connect to the database and save the message
			
			$resp = $db -> query($query);
			
			//send feedback
			if($resp){
				$data['code'] = 200;
				$data['text'] = 'message posté avec succès';
				die(json_encode($data));
			} else {
				$data['code'] = 500;
				$data['text'] = 'il y a eu une erreur';
				die(json_encode($data));
			}
		} else if($_POST['action'] == 'get-new-messages'){
			//$query = "SELECT * FROM (SELECT * FROM message ORDER BY messageID DESC LIMIT 5) as sq ORDER BY sq.messageID ASC;";
			$query = "SELECT * FROM message ORDER BY messageID ASC;";
			$resp = $db -> query($query);

			while($msg = $resp -> fetch_assoc()){

				$date = explode('-', $msg['date']);
				
				$msgYear = $date[0];
				$msgMonth = $date[1];
				$msgDay = $date[2];

				$time = explode(':', $msg['heure']);
				
				$msgHeure = $time[0];
				$msgMinute = $time[1];
				$msgSec = $time[2];

				if($msgYear == date('Y')){
					if($msgMonth == date('m')){
						if($msgDay == date('d')){
							if($msgHeure == date('G')){
								if($msgMinute == date('i')){
									$timeDisplay = 'just now';
								} else {
									$timeDisplay = date('i') - $msgMinute;
									$timeDisplay .= ' min ago';
								}
							} else {
								$timeDisplay = date('G') - $msgHeure;
								$timeDisplay .= ' hours ago';
							}
						} else {
							$timeDisplay = date('d') - $msgDay;
							$timeDisplay .= ' days ago';
						}
					} else {
						$timeDisplay = date('m') - $msgMonth;
						$timeDisplay .= ' months ago';
					}
				} else {
					$timeDisplay = date('Y') - $msgYear;
					$timeDisplay .= ' years ago';
				}
				
				$query = "SELECT couleur FROM utilisateur WHERE pseudo = '".$msg['auteur']."'";
				$couleur = $db -> query($query) -> fetch_assoc()['couleur'];
				
				echo '
					<div class="chat-message">
						<div class="message-head">
							<span style="color:#'.$couleur.'">'.$msg['auteur'].'</span> &#8226; '.$timeDisplay.'
						</div>
						<div class="message-content">
							'.$msg['valeur'].'
						</div>
					</div>
					';
			}
		}

	}

?>
