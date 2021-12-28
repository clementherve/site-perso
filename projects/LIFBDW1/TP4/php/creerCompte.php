<?php

//start the session
session_start();

//call the database class
require_once('db.class.php');
require_once('../conf.php');
$db = new db();


//check if all fields are here
if(isset($_POST['pseudo']) && isset($_POST['mdp1']) && isset($_POST['mdp2'])){

	//verifier si le pseudo est déjà pris
	$pseudo = htmlentities($_POST['pseudo']);
	$query = "SELECT * FROM utilisateur WHERE pseudo LIKE '".$pseudo."';";
	$resp = $db -> query($query);
	if($resp -> num_rows != 0){die('Le pseudo est déjà pris !');}


	//verifier si les mdp sont =
	if($_POST['mdp1'] != $_POST['mdp2']){
		die('Les mots de passe ne sont pas identiques');
	}


	//generer une couleur aleat
	$couleur;
	for($i=0;$i<6;$i++){$couleur .= rand(0,10);}

	//set active state
	$etat = 1;
	
	//hash pwd
	$mdp = md5($_POST['mdp1']);

	//make query
	$query = "INSERT INTO utilisateur (
		pseudo,
		mdp,
		couleur,
		etat
	) VALUES (
		'".$pseudo."',
		'".$mdp."',
		'".$couleur."',
		".$etat."
	);";

	//exc query
	$resp = $db -> query($query);

	//send resp
	echo $resp;

	if($resp){
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['mdp'] = $mdp;
		$_SESSION['couleur'] = $couleur;
	}

} else {
	die(false);
}

?>