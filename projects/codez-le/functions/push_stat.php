<?php
//prevent erasing
$log = json_decode(file_get_contents("../log/log.php"), true);

//fetch the data
$day = (gmdate("m")+0)."/".(gmdate("d")+0)."/".(gmdate("Y")+0);
$time = (gmdate("H")+0).":".(gmdate("i")).":".(gmdate("s"));
$ip = htmlspecialchars($_SERVER["REMOTE_ADDR"]);

//the page
if(isset($_POST["article"]) and !isset($_POST["q"])){
	$page = htmlspecialchars(strtolower($_POST["article"]));
} else if(isset($_POST["q"])) {
	$page = "search: ".htmlspecialchars(strtolower($_POST["q"]));
} else if(isset($_POST["lvl"]) and !isset($_POST["q"])){
	$page = htmlspecialchars($_POST["lvl"]);
}

//save the data
if(isset($page)){
	$log[$day][] = $time." - ".$page." - ".$ip;
	file_put_contents("../log/log.php", json_encode($log));
}

?>