<?php
	
	$useLocal = false;

	if($useLocal){
		//local
		$GLOBALS['dbname'] = 'LIFBDW1';
		$GLOBALS['host'] = 'localhost';
		$GLOBALS['username'] = 'clement';
		$GLOBALS['password'] = 'sezzano_69';
	} else {
		//online
		$GLOBALS['dbname'] = 'clementhlastream';
		$GLOBALS['host'] = 'clementhlastream.mysql.db';
		$GLOBALS['username'] = 'clementhlastream';
		$GLOBALS['password'] = 'Nooneisright56';
	}
	


	
?>
