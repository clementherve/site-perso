<?php

//start the session
session_start();

//call the database class
require_once('db.class.php');
require_once('../conf.php');
$db = new db();


//check if all fields are here
if(isset($_POST['pseudo']) && isset($_POST['mdp'])){

	//verifier si le pseudo est déjà pris
	$pseudo = htmlentities($_POST['pseudo']);
	$mdp = md5($_POST['mdp']);


	$query = "SELECT * FROM utilisateur WHERE pseudo = '".$pseudo."';";
	$resp = $db -> query($query);

	if($resp -> num_rows != 0){
		$user = $resp -> fetch_assoc();

		if($user['pseudo'] == $pseudo && $user['mdp'] == $mdp){
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['mdp'] = $user['mdp'];
			$_SESSION['couleur'] = $user['couleur'];

			$query = "UPDATE utilisateur SET etat = 1 WHERE pseudo LIKE '".$_SESSION['pseudo']."';";
			$db -> query($query);
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 0;
	}

} else {
	echo 0;
}

?>