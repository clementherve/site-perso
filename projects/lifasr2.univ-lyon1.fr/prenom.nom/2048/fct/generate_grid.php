<?php

require "add_2_4_rand.php";
require "display_grid.php";

if(isset($_POST["id"])){
	
	for($i=0;$i<4;$i++){
		for($j=0;$j<4;$j++){
			$grid[$i][$j] = 0;
		}
	}

	$grid = add_2_4_rand($grid);
	$grid = add_2_4_rand($grid);
	display_grid($grid);

	$game["grid"] = $grid;
	$game["score"] = 0;

	//save the grid
	file_put_contents("../../../DATA/2048/partie.json", json_encode($game));
}

?>