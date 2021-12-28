<?php
require "post.php";

//like a post (or not)
if(isset($_POST["filename"])){
	if(check_likes($_POST["filename"])){
		die();
	} else {
		$liked = json_decode(file_get_contents("../res/liked.json"), true);
		$liked[$_POST["filename"]] = "1";
		file_put_contents("../res/liked.json", json_encode($liked));
	}
	aimer($_POST["filename"]);
}

//return TRUE if the post was already liked by the same person
function check_likes($filename){
	//$liked = json_decode(file_get_contents("../res/liked.json"), true);
	//return isset($liked[$filename]);
	return false;
}

//increase from +1 the like counter
function aimer($fichier){
	$lines = file("../../../".$fichier);
	$nb_Like= $lines[3]+1;
	$lines[3]= $nb_Like."\n";
	file_put_contents("../../../".$fichier, $lines, LOCK_EX);
}
?>