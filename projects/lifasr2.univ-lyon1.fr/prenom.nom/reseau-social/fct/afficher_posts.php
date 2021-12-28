<?php
require_once "post.php";
require_once "retourne_com.php";

function afficher_posts($nbr="1", $type="all", $mode="normal"){

	//display only some matching posts
	if($type == "com"){
		$posts = glob("../../../DATA/*-com.txt");
	} else if($type == "msg"){
		$posts = glob("../../../DATA/*-msg.txt");
	} else if($type == "img"){
		$posts = glob("../../../DATA/*-img.txt");
	} else if($type == "noimg"){
		$posts = glob("../../../DATA/*-{com,msg}.txt", GLOB_BRACE);
	} else if($type == "nocom"){
		$posts = glob("../../../DATA/*-{img,msg}.txt", GLOB_BRACE);
	} else if($type == "nomsg"){
		$posts = glob("../../../DATA/*-{img,com}.txt", GLOB_BRACE);
	} else if($type == "all"){
		$posts = glob("../../../DATA/[0-9]*-*txt");
	} else {
		$posts = "";
	}

	//if there is not enough posts to show, set the $nbr to the max count
	if($nbr > count($posts) or $nbr == "all"){
		$nbr = count($posts);
	}

	//in case no matching posts were found
	if(empty($posts)){
		die("<center><i>No matching posts found!</i></center><br><br><br>");
	}

	//reverse sort (add SORT_NATURAL prevent weird english sorting)
	rsort($posts, SORT_NATURAL);

	//display the messages
	for($i=0; $i<$nbr; $i++){
		$file = post($posts[$i]);
		
		if($mode == "strict" and $file["type"] != "image" and strlen($file["message"])<5){
			$i++;
		} else {
			
			echo "<div class=\"message\" id=\"".preg_replace("#\.\./#", "", $posts[$i])."\">";
			echo "<h3 title=\"".preg_replace("#\.{2}|/|DATA#", "", $posts[$i])."\">{$file["nom"][1]}</h3>";
			echo "<h4>".preg_replace("# #"," @ ", $file["date"])."</h4>";

			echo "<div class=\"aimer\"><i class=\"material-icons\">+1</i><span class=\"count\">{$file["likes"]}</span></div>";
			if($file["type"] == "image"){
				echo "<img src=\"../../DATA/{$file["img"]}\">";
			}
			//replacing links (experimental)
			echo "<p>".preg_replace("#((https?://)*www\.(.*))( |$)#Ui", "<a href=\"http://www.$3\" target=\"_blank\">$3</a> ", nl2br(htmlentities(substr($file["message"],0,800))))."</p>";

			if(strlen($file["message"])>800){
				echo "<i id=\"warning\">LENGTH LIMIT EXCEEDED!</i>";
			}
			
			echo "<form class=\"zone_commentaire\"><input type=\"text\" placeholder=\"Votre réaction\"></textarea><input type=\"submit\" value=\"commenter\"></form>";

			// border-left: 1px solid #1e89d1;
			$coms = retourne_com($posts[$i]);
			if($coms[0] != false){
				foreach($coms as $com){
					$filecom = post($com);
					echo "<div class=\"msg_com\">";

					echo "<div class=\"nbr_likes\">".$filecom["likes"]."</div>";

					echo "<h5>".$filecom["nom"][1]." (".preg_replace("# #"," @ ", $filecom["date"]).")</h5>";
					
					//replacing links (experimental)
					echo "<p>".preg_replace("#((https?://)*www\.(.*))( |$)#Ui", "<a href=\"http://www.$3\" target=\"_blank\">$3</a> ", htmlentities(substr($filecom["message"],0,800)))."</p>";

					if(strlen($file["message"])>600){
						echo "<i id=\"warning\">LENGTH LIMIT EXCEEDED!</i>";
					}
					echo "</div>";
				}
			}

			
			echo "</div>";
		}
	}
}

//call the function
afficher_posts($_POST["nbr"], $_POST["type"], $_POST["mode"]);
?>
<!--darker is used to add a dark background when media preview is enabled-->
<div id="darker"></div>
<script>
	//add a like to a post
	$(".aimer").on("click", function(){
		var post = $(this).parent().attr("id")
		$.post("fct/aimer.php", {"filename":post})
	})

	//resume the long polling refresh
	$(".zone_commentaire").on("click", function(){
		localStorage.longPollingSuspend = "true"
	})

	//add a comment
	$(".zone_commentaire").on("submit", function(e){
		e.preventDefault()
		e.stopImmediatePropagation()

		//suspend the long polling refresh til the message is posted
		localStorage.longPollingSuspend = "false"

		var message = $(this).children(0).val(),
			post = $(this).parent(0).attr("id"),
			name = localStorage.username
			that = this
		$.post("fct/ajouter_com.php", {"message": message, "post":post, "name": name})
		.done(function(){
			that.firstChild.value = ""
		})
		return false
	})

	//media preview
	$("img").on("click", function(){
		var darker = $("#darker").css("visibility")
		if(darker == "hidden"){
			$("#darker").css({"visibility":"articleViewVisible"})
			$(this).css({"position":"fixed","height":"80vh", "width":"auto"})
		} else {
			$("#darker").css({"visibility":"hidden"})
			$(this).css({"position":"static","height":"auto", "width":"50%"})
		}
	})
</script>
