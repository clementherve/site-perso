<?php
if(isset($_POST["fname"]) and isset($_POST["fcontent"])){
	$sucess = file_put_contents("../../cours/".$_POST["fname"].".txt", $_POST["fcontent"]);
	if($sucess == true){ die("ok");} 
	else { die("error"); }
}
?>