<?php
if(isset($_POST["data_com"]) and isset($_POST["article"])){
	$data = "<div class=\"comment\">".$_POST["data_com"]."</div>";
	$article = file_get_contents("../".$_POST["article"]);
	$article = preg_replace("#".$data."#", "", $article);
	$article = preg_replace("#\n#", "", $article);

	if(empty($article)){
		unlink("../".$_POST["article"]);
	} else {
		file_put_contents("../".$_POST["article"], $article);
	}
}
?>