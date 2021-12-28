<?php

if(isset($_POST["title"]) and isset($_POST["content"]) and isset($_POST["lvl"]) and isset($_POST["published"]) and isset($_POST["id"])){

	$article["title"] = $_POST["title"];
	$article["content"] = $_POST["content"];
	$article["lvl"] = $_POST["lvl"];
	$article["published"] = $_POST["published"];
	$article["id"] = $_POST["id"];

	$path = transliterator_transliterate("LATIN-ASCII", preg_replace("# #", "-", strtolower($_POST["id"]))).".json";


	//main file content
	$save = file_put_contents("../../articles/".$path, json_encode($article));

	//update json dataset
	$list = json_decode(file_get_contents("../../articles/index.json"), true);
	$list[$article["lvl"]][$path] = $_POST["published"];
	$json = file_put_contents("../../articles/index.json", json_encode($list));

	//do
	if($save){
		echo "Sauvegarde réussie !";
	} else {
		echo "Echec :/";
	}

} else {
	echo "Il manque des données !";
}

?>