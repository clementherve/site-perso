<?php

//grab a message and outputs a data array
function post($file){
	$file_data = file($file);

	$data["type"] = trim(array_shift($file_data));
	$data["nom"][0] = array_shift($file_data);
	$data["nom"][1] = preg_replace("#\.#", " ", $data["nom"][0]);
	$data["date"] = array_shift($file_data);
	$data["likes"] = array_shift($file_data);
	
	switch ($data["type"]){
		case "message":
			$data["message"] = trim(implode($file_data, " "));
			
			break;
		case "image":
			array_shift($file_data);
			$data["img"] = array_shift($file_data);
			
			//Prevent media error
			if( !file_exists("../../DATA/".$data["img"]) ){
				preg_match("#\./IMG/(.*)\n#", file_get_contents($file), $img);
				$data["img"] = "./IMG/".$img[1];			
			}
			
			$data["message"] = trim(implode($file_data, " "));
			break;
		case "commentaire":
			array_shift($file_data);
			$data["com"] = array_shift($file_data);
			$data["message"] = trim(implode($file_data, " "));
			break;
	}

	return $data;
}

//keep count of how many messages were posted
function prendre_un_post() {
	$nbPost = file_get_contents("../../../DATA/nb-post.txt");
	$nouveau_nbPost = $nbPost + 1; 
	file_put_contents("../../../DATA/nb-post.txt", $nouveau_nbPost, LOCK_EX);
	return trim($nbPost);	
} 

?>
