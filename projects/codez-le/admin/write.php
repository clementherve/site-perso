<div class="blackout"></div>

<div class="popup1">
	<div class="popup2"></div>
	<div class="lvl">
		<span data-lvl="debutant">Débutant</span>
		<span data-lvl="intermediaire">Intermédiaire</span>
		<span data-lvl="confirme">Confirmé</span>
	</div>
	<div class="published">Publié</div>
	<div class="save">Enregistrer l'article</div>
</div>

<form id="write">	
	<input type="text" name="title" placeholder="Titre" <?php m("title")?>>
	<input type="hidden" name="id" <?php m("id") ?>>
	<textarea name="content" placeholder="Ecrivez..."><?php m("content")?></textarea>
</form>

<div class="fab"><i class="material-icons">save</i></div>

<script>


	//popup management
	$(".fab").on("click", function(){
		$(".blackout").show();
		$(".popup1").show();
		$(".save").empty().html("Enregistrer l'article");
	});
	$(".lvl span").on("click", function test(){
		$(".lvl span").css({"opacity":"0.3"});
		$(this).css({"opacity":"1"});
		var lvl = $(this).attr("data-set");
		return test;
	});
	$(".published").on("click", function(){
		var color = $(this).css("background-color");
		if(color === "rgb(238, 238, 238)"){
			$(this).css({"background-color":"#4caf50"});
		} else {
			$(this).css({"background-color":"rgb(238, 238, 238)"});
		}
	});
	//saving article
	$(".save").on("click", function(){
		//get lvl info
		for(var i =0; i<3; i++){
			if(document.querySelectorAll(".lvl span")[i].style.opacity === "1"){
				var lvl = document.querySelectorAll(".lvl span")[i].getAttribute("data-lvl");
			}
		}
		//get published status
		if($(".published").css("background-color") === "rgb(238, 238, 238)"){
			var published = "false";
		} else {
			var published = "true";
		}
		//get title + content
		var title = $("input[type=text]").val();
			content = $("textarea").val(),
			id = $("input[type=hidden]").val();

		//prevent errors
		if(lvl === undefined){
			lvl = "debutant";
		}
		//send ajax call
		$.post("admin/functions/save.php", {"title":title, "content":content, "lvl":lvl, "published":published, "id":id})
		.always(function(data){
			$(".save").empty().html(data);
		})
	})
	//back to writer
	$(".blackout").on("click", function(){
		$(this).hide();
		$(".popup1").hide();
	})
	<?php m("published"); echo m("lvl") ?>
</script>

<?php

function m($attr){
	if(isset($_GET["a"])){

		$article = json_decode(file_get_contents("../articles/".$_GET["a"]),true);

		if($attr == "title"){
			echo " value=\"".htmlentities($article["title"])."\"";
		}
		if($attr == "content"){
			echo htmlentities($article["content"]);
		}
		if($attr == "published" and $article["published"] == "true"){
			echo "$(\".published\").css({\"background-color\":\"#4caf50\"});\n";
		}
		if($attr == "lvl"){
			?>
			for(var i=0; i<3; i++){
				document.querySelectorAll(".lvl span")[i].style.opacity = "0.3";
				if(document.querySelectorAll(".lvl span")[i].getAttribute("data-lvl") === "<?php echo $article["lvl"] ?>"){
					document.querySelectorAll(".lvl span")[i].style.opacity = "1";

				}
			}
			<?php
		}
		if($attr == "id"){
			echo " value=\"".$article["id"]."\"";
		}
	}
	if($attr == "id"){
		echo " value=\"".time()."\"";
	}
}

?>