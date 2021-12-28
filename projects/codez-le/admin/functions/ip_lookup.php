<?php
(!isset($_POST["ip"]))?die():"";
$ip = $_POST["ip"];

$log = file_get_contents("../../log/log.php");
$ip_occur = preg_match_all("#".$ip."#", $log);
$data = json_decode(file_get_contents("https://ipinfo.io/".$ip), true);
echo "<hr>";
echo (isset($data["hostname"])) ?  "<p>Serveur: ".$data["hostname"]."</p>\n" : "<p>Serveur: unknown</p>\n";
echo (isset($data["org"])) ?  "<p>Société: ".$data["org"]."</p>\n" : "<p>Société: unknown</p>\n";
echo (isset($data["country"])) ?  "<p>Pays: ".$data["country"]."</p>\n" : "<p>Pays: unknown</p>\n";
echo (isset($data["region"])) ?  "<p>Région: ".$data["region"]."</p>\n" : "<p>Région: unknown</p>\n";
echo "<p>Nombre de pages vues: {$ip_occur}</p>";
?>