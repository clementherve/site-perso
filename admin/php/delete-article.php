<?php

if (!isset($_POST['id'])) {
    die("Missing data");
}

include_once("/php/article.php");

// $path = "../../articles/".$_POST['id'].".json";

// if(file_exists($path)){
//     if(unlink($path)){
//         die("{\"status\":\"ok\"}");
// 	} else {
// 		die("{\"status\":\"permission-error\"}");
// 	}
// } else {
//     die("{\"status\":\"file-doesnt-exists\"}");
// }
?>
