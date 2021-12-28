<?php



if(file_exists('../conf.php')){
	require_once('../conf.php');
} else {
	require_once('conf.php');
}

class db{

	//-> sql obj.
	private function sql(){
		return new mysqli($GLOBALS['host'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
	}

	//-> sql res. obj.
	public function query($query){
		$sql = $this -> sql();
		$sql -> set_charset('utf8');
		$res = $sql -> query($query);
		// var_dump($sql -> error);//-- DEBUG PURPOSE ONLY
		$sql -> close();
		return $res;
	}
}

?>