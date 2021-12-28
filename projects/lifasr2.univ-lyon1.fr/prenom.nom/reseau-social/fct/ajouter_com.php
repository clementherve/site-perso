<?php
require_once("post.php");

//return how many messages were posted
function nb_posts(){
	return count(glob("../../../DATA/*.txt"));
}
if(empty($_POST["message"] or empty($_POST["name"]))){
	die();
}
$type="com";
$typelong = "commentaire";

$filecontent = $typelong."\n".$_POST["name"]."\n".date("Y-m-d H:i:s")."\n0\n\n";
$filecontent .= preg_replace("#DATA#", ".", $_POST["post"])."\n".$_POST["message"];

file_put_contents("../../../DATA/".prendre_un_post()."-".$type.".txt", $filecontent, LOCK_EX);
?>
