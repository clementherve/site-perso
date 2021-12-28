<?php
	
	require_once('db.class.php');
	require_once('../conf.php');
	$db = new db();

	$query = "SELECT pseudo, etat FROM utilisateur WHERE etat = 1;";
	$resp = $db -> query($query);

	while($row = $resp -> fetch_assoc()){
		echo '<li>'.$row['pseudo'].'</li>';
	}
?>