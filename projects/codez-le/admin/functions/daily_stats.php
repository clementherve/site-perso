<?php
$log = json_decode(file_get_contents("../../log/log.php"), true);
$today = (gmdate("m")+0)."/".(gmdate("d")+0)."/".(gmdate("Y")+0);
$today2 = (gmdate("d")+0)."/".(gmdate("m")+0)."/".(gmdate("Y")+0);
$pviews = 0;
$newcom = 0;
$content = "";

//headers
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//pages vues
foreach($log as $day => $array){
	$pviews += count($array);
}

//new coms
$coms = glob("../../comments/*.json");
foreach($coms as $com){
	$com = file_get_contents($com);
	if(preg_match("#".$today2."#", $com)){
		$newcom++;
	}
}

if(isset($log[$today])){
	$content .= "<div style=\"background-color: #ff8a65; text-align: center; font-family: monospace; padding: 20px 0px; color: white; font-size: 20px; margin-top: 50px; border-left: 5px solid #ff5722; border-radius: 4px\">{$pviews} pages vues</div>";
	
	$content .= "<div style=\"background-color: #ff8a65; text-align: center; font-family: monospace; padding: 20px 0px; color: white; font-size: 20px; border-left: 5px solid #ff5722; border-radius: 4px\">".$today."</div>";
	foreach($log[$today] as $entry){
		$content .= "<div style=\"background-color: #eeeeee; padding: 10px 0px; border-radius: 4px; font-family: monospace; font-size: 13px; text-align: center; margin: 7px 0px;\">".strip_tags($entry)."</div>";
	}
}
if($newcom == 1){
	$content .= "<div style=\"background-color: #ff8a65; text-align: center; font-family: monospace; padding: 20px 0px; color: white; font-size: 20px; margin-top: 50px; border-left: 5px solid #ff5722; border-radius: 4px\">{$newcom} nouveau commentaire</div>";		
}
if($newcom > 1){
	$content .= "<div style=\"background-color: #ff8a65; text-align: center; font-family: monospace; padding: 20px 0px; color: white; font-size: 20px; margin-top: 50px; border-left: 5px solid #ff5722; border-radius: 4px\">{$newcom} nouveaux commentaires</div>";	
}

if(isset($log[$today]) or $newcom >= 0){
	mail("clementherve69@gmail.com", "Récapitulatif statistique", $content, $headers);
}
?>
