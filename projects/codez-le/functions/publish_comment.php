<?php

if(isset($_POST["content"]) and isset($_POST["author"]) and isset($_POST["article"])){

	$content = htmlspecialchars(strip_tags($_POST["content"]));
	$author = htmlspecialchars(strip_tags($_POST["author"]));
	$article = htmlspecialchars(strip_tags($_POST["article"]));
	$path = "../comments/";
	//$date = gmdate("d/m/Y")." à ".gmdate("H:i:s");
	$date = (gmdate("d")+0)."/".(gmdate("m")+0)."/".(gmdate("Y"))." à ".gmdate("H:i:s");

	if(file_exists($path.$article)){
		$data = file_get_contents($path.$article)."\n";
		$data .= "<div class=\"comment\">\n\t<span><b>{$author}</b> - {$date}</span>\n\t<p>{$content}</p>\n</div>\n";
	} else {
		$data = "<div class=\"comment\">\n\t<span><b>{$author}</b> - {$date}</span>\n\t<p>{$content}</p>\n</div>\n";
	}

	if(file_put_contents($path.$article, $data)){
		echo "<div class=\"success\">Message posté avec succès !</div>";
	} else {
		echo "<div class=\"failure\">Erreur lors de l'envoi du message</div>";
	}
} else {
	die("<div class=\"failure\">Erreur lors de l'envoi du message</div>");
}

?>