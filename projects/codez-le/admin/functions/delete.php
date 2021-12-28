<?php

if(isset($_POST["d"]) and file_exists("../../articles/".$_POST["d"])){
	unlink("../../articles/".$_POST["d"]);
}

$list = file_get_contents("../../articles/index.json");
$list = preg_replace("#\"".$_POST["d"]."\":\".*\"#U", "", $list);
$list = preg_replace("#,}#", "}", $list);
$list = preg_replace("#{,#", "{", $list);

file_put_contents("../../articles/index.json", $list);

?>