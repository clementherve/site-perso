<?php

if(isset($_POST["article"])){

	$article = $_POST["article"];
	$path = "../comments/";

	if(file_exists($path.$article)){
		echo file_get_contents($path.$article);
	}

}

?>