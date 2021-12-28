<?php

require_once("post.php");

//add a new post (with or without pictures)
if( isset($_POST["message"]) and isset($_POST["nom"]) ){
	$type = false;
	//cas image: on se fiche de savoir si un message est joint ou non
	if( isset($_FILES["media"]["tmp_name"]) and !empty($_FILES["media"]["name"]) ){
		$type="img";
		$filecontent = poster_image();
	} else {
		//standalone post
		if( !empty($_POST["message"]) ){
			$type = "msg";
			$filecontent = poster_message();
		} else {
			echo "<b>error:</b> please add a message";
		}
	}

	if($type != false){
		//create the filename
		$filename = prendre_un_post()."-".$type.".txt";
		
		//save the data
		if(file_put_contents("../../../DATA/".$filename, $filecontent, LOCK_EX)){
			echo "<b>success</b>";
		} else {
			echo "<b>error:</b> saving message";
		}
	}

} else {
	echo "<b>error:</b> missing information";
}

//post a picture
function poster_image(){
	$type="img";
	$typelong = "image";
	
	$image = $_FILES["media"]["tmp_name"];
	$dimension = getimagesize($image);
	$tmp = explode(".", $_FILES["media"]["name"]);
	$fichier = time().".".$tmp[ count($tmp)-1 ];

	if(preg_match("#^image/#", mime_content_type($image)) ){
		if ($dimension[0] > 2000 or $dimension[1] > 2000){
			$img = reduit_image($image, $dimension, $fichier);
		} else {
			$img = $image;
		}
		$dossier = "../../../DATA/IMG/";
		if(!move_uploaded_file($img, $dossier.$fichier)){
			die("<b>error: </b> saving the picture</b>");
		}
	} else {
		die("<b>error:</b> incorrect size or mime</b>");
	}
	$filecontent = $typelong."\r\n".$_POST["nom"]."\r\n".date("Y-m-d H:i:s")."\r\n0\r\n\r\n./IMG/".$fichier."\r\n".$_POST["message"];

	return $filecontent;
}

//post a msg
function poster_message(){
	$type = "msg";
	$typelong = "message";
	$filecontent = $typelong."\r\n".$_POST["nom"]."\r\n".date("Y-m-d H:i:s")."\r\n0\r\n\r\n".$_POST["message"];
	
	return $filecontent;
}

//resize a picture (O. Gluck's code!!)
function reduit_image($image, $dimension, $fichier) {
	$useGD = True ; 
	$to = "../../../DATA/IMG/".$fichier ;
	$ratio = $dimension[0]/$dimension[1];
	$hauteur = 300 ; 
	$largeur = round($hauteur*$ratio);
	if($useGD){
		$chemin = imagecreatetruecolor($largeur, $hauteur);
		$type = mime_content_type($image);
		switch (substr($type, 6)) {
			case 'jpeg':
				$img = imagecreatefromjpeg($image);
				break;
			case 'gif':
				$img = imagecreatefromgif($image);
				break;
			case 'png':
				$img = imagecreatefrompng($image);
				break;
		}
		imagecopyresampled($chemin, $img, 0, 0, 0, 0, $largeur, $hauteur, $dimension[0], $dimension[1]);
		imagedestroy($img);
		imagejpeg($chemin, $to, 100);	
	}
}
?>
