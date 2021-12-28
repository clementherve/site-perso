<?php
//display the grid for the ajax call
function display_grid($grid){
	for($i=0; $i<4;$i++){
		for($j=0; $j<4;$j++){
			if($grid[$i][$j] == 0){
				echo "<div class=\"tile\"></div>";
			} else {
				echo "<div class=\"tile _{$grid[$i][$j]}\">{$grid[$i][$j]}</div>";
			}
		}
	}
}

//return a string containing the grid
function html_grid($grid){
	$grid_string = "";
	for($i=0; $i<4;$i++){
		for($j=0; $j<4;$j++){
			if($grid[$i][$j] == 0){
				$grid_string .= "<div class=\"tile\"></div>\n";
			} else {
				$grid_string .= "<div class=\"tile _{$grid[$i][$j]}\">{$grid[$i][$j]}</div>\n";
			}
		}
	}
	return $grid_string;
}
?>