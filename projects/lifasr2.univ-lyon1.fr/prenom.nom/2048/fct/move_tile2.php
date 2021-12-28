<?php
require "display_grid.php";
require "add_2_4_rand.php";
require "is_grid_full.php";


if(isset($_POST["move"])){
	$mt = $_POST["move"];
	$grid = json_decode(file_get_contents("../../../DATA/2048/partie.json"), true);

	//left merge
	if($mt == "left"){
		for($j=0;$j<4;$j++){
			 $grid[$j] = merge_tile_left(move_tile_left($grid[$j]));
			//$grid[$j] = move_tile_left($grid[$j]);
		}
		display_grid($grid);
	}
	//right merge
	else if($mt == "right"){
		for($j=0;$j<4;$j++){
			$grid[$j] = merge_tile_right(move_tile_right($grid[$j]));
			//$grid[$j] = move_tile_right($grid[$j]);
		}
		display_grid($grid);
	}
	//up merge
	else if($mt == "up"){
		
		$grid = swap_array($grid);
		for($j=0;$j<4;$j++){
			$grid[$j] = merge_tile_left(move_tile_left($grid[$j]));
			//$grid[$j] = move_tile_left($grid[$j]);
		}
		$grid = swap_array($grid);
		display_grid($grid);
		
	}
	//down merge
	else {
		
		$grid = swap_array($grid);
		for($j=0;$j<4;$j++){
			$grid[$j] = merge_tile_right(move_tile_right($grid[$j]));
			//$grid[$j] = move_tile_right($grid[$j]);
		}
		$grid = swap_array($grid);
		display_grid($grid);
		
	}

	if(!is_grid_full($grid)){
		$grid = add_2_4_rand($grid);
	} else {
		echo "<div id=\"endgame\">The end!</div>";
	}
	//save the data
	file_put_contents("../../../DATA/2048/partie.json", json_encode($grid));
}


//move tiles
function move_tile_left($line){
	$newline = array_fill(0, 4, 0);
	$l=0;
	for($i=0;$i<4;$i++){
		if($line[$i] != 0){
			$newline[$l] = $line[$i];
			$l++;
		}
	}
	return $newline;
}
function move_tile_right($line){
	$newline = array_fill(0, 4, 0);
	$l=3;
	for($i=0;$i<4;$i++){
		if($line[$i] != 0){
			$newline[$l] = $line[$i];
			$l--;
		}
	}
	return $newline;
}


//merge tiles
function merge_tile_left($line){
	$newline = array_fill(0, 4, -1);
	for($i=0; $i<3; $i++){

		if($line[$i] == $line[$i+1] and $line[$i] != -1){
			$newline[$i] = 2*$line[$i];
			$newline[$i+1] = 0;
		} else {
			if($newline[$i] == -1){
				$newline[$i] = $line[$i];
			} else {
				$newline[$i] = 0;
			}
		}
		if($newline[$i] == -1){
			$newline[$i] = 0;
		}

	}
	return $newline;
}
function merge_tile_right($line){
	$newline = array_fill(0, 4, -1);
	for($i=1; $i<4; $i++){
		if($line[$i] == $line[$i-1] and $line[$i] != -1){
			$newline[$i] = 2*$line[$i];
			$newline[$i-1] = 0;
		} else {
			if($newline[$i] == -1){
				$newline[$i] = $line[$i];
			} else {
				$newline[$i] = 0;
			}
		}
		if($newline[$i] == -1){
			$newline[$i] = 0;
		}
	}
	return $newline;
}


//swap row and columns in an array so we can reuse previously built functions
function swap_array($in){
	foreach($in as $x => $row){
		foreach($row as $y => $content){
			$out[$y][$x] = $content;
		}
	}
	return $out;
}

?>