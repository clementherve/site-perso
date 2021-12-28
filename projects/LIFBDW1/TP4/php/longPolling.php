<?php

require_once('db.class.php');
require_once('../conf.php');

$db = new db();

$query = "SELECT count(*) as nb FROM message";

$n_start = $db -> query($query) -> fetch_assoc()['nb'];
$n_current = $n_start;

$timeout = 0;
$tmax = 10;

while($n_start == $n_current AND $timeout < $tmax){
	$n_current = $db -> query($query) -> fetch_assoc()['nb'];
	$timeout++;
	sleep(2);
}

echo $n_current - $n_start;
?>