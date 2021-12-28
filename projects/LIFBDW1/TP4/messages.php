<?php
session_start();

require_once('php/db.class.php');
require_once('conf.php');
$db = new db();

//check connex
if(!isset($_SESSION['pseudo']) || !isset($_SESSION['mdp'])){
	header('Location: index.php');
} else {

	$pseudo = htmlentities($_SESSION['pseudo']);
	$mdp = md5($_SESSION['mdp']);


	$query = "SELECT * FROM ".$_GLOBAL['db'].".utilisateur WHERE pseudo LIKE '".$pseudo."';";
	$resp = $db -> query($query);
	
	if($resp -> num_rows == 0){
		header('Location: index.php');
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LIFBW1 - TP4 (chat)</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<meta name="viewport" content="width = device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>

	<div id="wrap">
		
		<div id="left-panel">
			<h1><span>Wilkommen</span> <?php echo $_SESSION['pseudo']; ?></h1>

			<div id="active-users">
				<h3>Utilisateurs en ligne</h3>
				<ul></ul>
			</div>

			<a href="php/deconnexion.php" id="disconnect" class="button">Deconnexion</a>
		</div>

		<div id="chat-head">
			<div id="chat-menu">
				<i class="material-icons">menu</i>
			</div>

			<div id="chat-info">
				LIFBDW1 tchat v1.0
			</div>
		</div>


		<div id="right-panel">
			
			<div id="chat-thread"></div>
			<div id="popup">popup</div>
			<div id="chat-bottom">
				<input type="text" name="send-message" id="message-content" placeholder="Type here..">
			</div>
		</div>

	</div>
	<script src="js/index.js"></script>
</body>
</html>