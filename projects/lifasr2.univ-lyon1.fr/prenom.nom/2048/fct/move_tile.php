<?php
require "display_grid.php";
require "add_2_4_rand.php";
require "is_grid_full.php";


if(isset($_POST["move"])){
	$mt = $_POST["move"];
	$data = json_decode(file_get_contents("../../../DATA/2048/partie.json"), true);
	
	$game["score"] = $data["score"];
	$game_json["score"] = $data["score"];

	$grid = $data["grid"];
	//var_dump($grid);

	//left merge
	if($mt == "left"){
		for($j=0;$j<4;$j++){
			 $grid[$j] = move_tile_left(merge_tile_left(move_tile_left($grid[$j]), $game["score"]));
		}
	}
	//right merge
	else if($mt == "right"){

		for($j=0;$j<4;$j++){
			$grid[$j] = move_tile_right(merge_tile_right(move_tile_right($grid[$j]), $game["score"]));
		}
	}
	//up merge
	else if($mt == "up"){
		
		$grid = swap_array($grid);
		for($j=0;$j<4;$j++){
			 $grid[$j] = move_tile_left(merge_tile_left(move_tile_left($grid[$j]), $game["score"]));
		}
		$grid = swap_array($grid);
		
	}
	//down merge
	else {
		
		$grid = swap_array($grid);
		for($j=0;$j<4;$j++){
			$grid[$j] = move_tile_right(merge_tile_right(move_tile_right($grid[$j]), $game["score"]));
		}
		$grid = swap_array($grid);	
	}

	if(!is_grid_full($grid)){
		$grid = add_2_4_rand($grid);

		$game_json["grid"] = $grid;
		$game["grid"] = html_grid($grid);
	} else {
		$game["grid"] = html_grid($grid);
		$game["grid"] .= "<div id=\"endgame\">The end!</div>";

		$game_json["grid"] = $grid;
	}
	$game_json["score"] = $game["score"];

	echo json_encode($game);

	//save the data
	file_put_contents("../../../DATA/2048/partie.json", json_encode($game_json));
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
function merge_tile_left($line, &$score){
	for($i=0; $i<3; $i++){
		if($line[$i] != 0){
			if($line[$i] == $line[$i+1]){
				$line[$i] = 2*$line[$i];
				$line[$i+1] = 0;
				$score += $line[$i];
			} else {
				$line[$i] = $line[$i];
			}
		}
	}
	return $line;
}
function merge_tile_right($line, &$score){
	for($i=0; $i<3; $i++){
		if($line[$i] != 0){
			if($line[$i] == $line[$i+1]){
				$line[$i+1] = 2*$line[$i];
				$line[$i] = 0;
				$score += $line[$i];
			} else {
				$line[$i] = $line[$i];
			}
		}
	}
	return $line;
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