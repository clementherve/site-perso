<div class="blackout"></div>
<?php
require "push_stat.php";
if(isset($_POST["article"]) and file_exists("../articles/".$_POST["article"])){  
    $article = json_decode(file_get_contents("../articles/".$_POST["article"]), true);
    (!$article["published"])?die("not published!"):"";
    echo "<h3>".htmlentities($article["title"])."</h3>";
    echo $article["content"];
} else {
    die("error: article not found");
}
?>
<script src="js/google-code-prettify/run_prettify.js"></script>
<script>
	//img zoom
    $(".data img").on("click", function(){
        if($(this).css("position") === "fixed"){
        	$(".data img").css({"position":"static", "top":"", "bottom":"", "right":"", "left":"", "z-index":"", "margin-top":"", "transform":""});
        	$(".blackout").hide();
        } else {
        	$(".blackout").show();
        	$(this).css({"position":"fixed", "top":"0", "bottom":"0", "right":"0", "left":"0", "z-index":"5", "margin-top":"50vh", "transform":"translateY(-50%)"});
        }
    });
</script>