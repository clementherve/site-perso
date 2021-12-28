<?php

function is_grid_full($grid){
	$full = true;
	for($i=0; $i<4; $i++){
		for($j=0; $j<4; $j++){
			if($grid[$i][$j] == 0){
				$full = false;
			}
		}
	}
	return $full;
}

?>