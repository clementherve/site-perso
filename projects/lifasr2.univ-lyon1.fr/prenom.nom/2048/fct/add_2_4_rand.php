<?php
function add_2_4_rand($grid){
	//pick the tile
	do{
		$x = rand(0, 3);
		$y = rand(0, 3);
	}while($grid[$x][$y] != 0);

	//pick the number
	if(rand(0, 1) == 0){
		$grid[$x][$y] = 2;
	} else {
		$grid[$x][$y] = 4;
	}

	//return the grid
	return $grid;
}
?>