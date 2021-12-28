<?php
/*
- retourne les commentaires associés à un post
*/
function retourne_com($filename){
	$coms = glob("../../../DATA/*-com.txt");

	$i=0;
	foreach($coms as $com){
		$msg = explode("\n", file_get_contents($com))[5];
		if(preg_match("#".$msg."#", $filename)){
			$matched_com[$i] =$com;
			$i++;
		}
	}

	if(isset($matched_com[0])){
		return $matched_com;
	} else {
		return false;
	}
}

?>