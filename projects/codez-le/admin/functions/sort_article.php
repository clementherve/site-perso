<?php

//send back the title for testing purpose
function title($id){
	return json_decode(file_get_contents("../../articles/".$id),true)["title"];
}

//init vars
$id = $_POST["id"];
$lvl = $_POST["lvl"];
$ipos = $_POST["o_pos"];
$npos = $_POST["n_pos"];

//abort case
($ipos == $npos)?die():"";

//get data
$json = file_get_contents("../../articles/index.json");
$array = json_decode($json, true);

//get cut item
preg_match("#(\"".$id."\":\".*\")#U", $json, $cut);
(isset($cut[1]))?$cut = $cut[1]:die();
print_r("moved: ".$id."(".title($id).")");

//get previous item
$prev = array_keys($array[$lvl])[$npos];
print_r("\nprevious: ".$prev."(".title($prev)." - ".$npos.")");

//delete the moved part in the json
$json2 = preg_replace("#".$cut.",*#", "", $json);

//append the moved part after the "previous" item
if($ipos < $npos){
	$json3 = preg_replace("#(\"".$prev."\":\".*\")#U", "$1,".$cut, $json2);
} else {
	$json3 = preg_replace("#(\"".$prev."\":\".*\")#U", $cut.",$1", $json2);
}

//prevent bug
$json3 = preg_replace("#,}#", "}", $json3);
$json = preg_replace("#{,#", "{", $json);
if(strlen($json3) == strlen($json)){
	file_put_contents("../../articles/index.json", $json3);
} else {
	echo "\nnot the same length";
}
?>