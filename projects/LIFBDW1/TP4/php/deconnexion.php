<?php
session_start();
require_once('db.class.php');
require_once('../conf.php');

$db = new db();

$query = "UPDATE utilisateur SET etat = 0 WHERE pseudo LIKE '".$_SESSION['pseudo']."';";
$db -> query($query);

session_destroy();
header('Location: ../index.php');

?>