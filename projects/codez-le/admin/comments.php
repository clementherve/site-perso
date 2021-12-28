<?php

$coms = glob("../comments/*.json");
foreach($coms as $path){
	$comment = file_get_contents($path);
	$title = json_decode(file_get_contents(preg_replace("#comments#", "articles", $path)), true)["title"];
	echo "<h4>{$title}</h4>";
	echo "<div data-a=\"{$path}\">";
	echo $comment;
	echo "</div>";
}

?>

<script>
	
	$(".comment").on("click", function(){
		var com = $(this).html(),
			article = $(this).parent().attr("data-a");

		var confirm = window.confirm("Supprimer le commentaire ?");
		if(confirm){
			$.post("admin/functions/delete_comment.php", {"data_com":com, "article":article})
			.always(function(data){
				$(".content").load("admin/comments.php");
			});
		}
		
	});

</script>