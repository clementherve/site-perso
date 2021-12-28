<?php

	if(!isset($_POST['title']) || !isset($_POST['content']) || !isset($_POST['tags']) || !isset($_POST['id']) || !isset($_POST['is-draft'])){
		die("Missing data");
	}

	$article['title'] = $_POST['title'];
	$article['ID'] = $_POST['id'];
	$article['content'] = $_POST['content'];
	$article['tags'] = explode(',', $_POST['tags']);
	$article['date'] = date('j/m/Y - G:i');
	$article['is-draft'] = false;

	$path = '../../articles/'.$article['ID'].'.json';
	
	if (file_put_contents($path, json_encode($article))) {
		die("Ok !");
	} else {
		die("Error while writing file");
	}

?>
