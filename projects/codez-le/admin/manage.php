<?php
/*function selector(){//Sort by lvl
	$list1 = glob("../articles/*.json");
	foreach($list1 as $path){
		if(!preg_match("#index.json#", $path)){
			$article = json_decode(file_get_contents($path),true);
			$list[$article["lvl"]][$article["id"].".json"] = $article["published"];
		}
	}
	return $list;
}*/
//complex sorting
function sort_lvl($lvl1, $lvl2){
	if($lvl1 == "debutant" and $lvl2 == "intermediaire"){
		return -1;
	} else
	if($lvl1 == "debutant" and $lvl2 == "confirme"){
		return -2;
	} else 
	if($lvl1 == "confirme" and $lvl2 == "intermediaire"){
		return 1;
	} else 
	if($lvl1 == "confirme" and $lvl2 == "debutant"){
		return 2;
	} else 
	if($lvl1 == "intermediaire" and $lvl2 == "confirme"){
		return -1;
	} else 
	if($lvl1 == "intermediaire" and $lvl2 == "debutant"){
		return 1;
	}
}
$list = json_decode(file_get_contents("../articles/index.json"), true);
uksort($list, "sort_lvl");
foreach($list as $lvl => $data){
	echo "<h3 class=\"list_head\">{$lvl}</h3><div class=\"sortable\">";
	foreach($data as $path => $published){
		$article = json_decode(file_get_contents("../articles/".$path),true);
		$title = htmlentities($article["title"]);
		echo ($published != "true")?"<div class=\"list unpublished ui-state-default\" path=\"{$path}\" lvl=\"{$lvl}\">":"<div class=\"list ui-state-default\" path=\"{$path}\" lvl=\"{$lvl}\">";
		echo "<div>{$title}</div>";
		echo "<div><a href=\"{$path}\" class=\"button modify\">modifier</a><a href=\"{$path}\" class=\"button delete\">supprimer</a></div>";
		echo "</div>";
	}
	echo "</div>";
}
?>
<div class="popup"></div>
<script>
	//modify
	$(".modify").on("click", function(e){
		e.preventDefault;
		e.stopImmediatePropagation;
		var path = $(this).attr("href");
		$(".content").load("admin/write.php?a="+path);
		return false;
	});
	//delete
	$(".delete").on("click", function(e){
		e.preventDefault;
		e.stopImmediatePropagation;
		var path = $(this).attr("href");
		var resp = confirm("delete ?");
		if(resp === true){
			$.post("admin/functions/delete.php", {"d":path});
			$(".content").load("admin/manage.php");
		}
		return false;
	});
	//sortable
	 $( function() {
	    $(".sortable").sortable({
	    	start: function(event, ui) {
        		o_pos = ui.item.index();
                id = ui.item.attr("path");
                lvl = ui.item.attr("lvl");
    		},
	    	update: function(event, ui) {
        		n_pos = ui.item.index();
        		$.post("admin/functions/sort_article.php", {"o_pos":o_pos, "n_pos":n_pos, "id":id, "lvl":lvl})
        		.always(function(data){
        			console.log(data);
                    $(".content").load("admin/manage.php");
        		});
    		}
    	});
	    //$(".sortable").disableSelection();
  	});
</script>