<?php

require "push_stat.php";

function all_article($niveau){

    $list = json_decode(file_get_contents("../articles/index.json"), true);
    $level = transliterator_transliterate("LATIN-ASCII", strtolower($niveau));
    
    $niveau = preg_replace("#\##", "", $niveau);
    
    if($niveau == "Débutant"){
        $level = $list["debutant"];
    } else 
    if($niveau == "Intermédiaire"){
        $level = $list["intermediaire"];
    } else
    if($niveau == "Confirmé"){
        $level = $list["confirme"];
    } else 
    if($niveau == "Vidéo"){
        die("<center>Not ready yet!</center>");
        //$level = $list["video"];
    } else {
        die("<p>Error: no matching level found</p>");
    }
    
    
    echo "<h3>Cours {$niveau}</h3>";
    foreach($level as $id => $published){
        $article = json_decode(file_get_contents("../articles/".$id),true);
        if($article["published"] == "true"){
            //img
            preg_match("#<img src=\"(.*)\"#", $article["content"], $img);
            if(isset($img[1]) and file_exists("../".$img[1])){
                $img = $img[1];
            } else {
                $img = "img/default.jpg";
            }
            //excerpt
            $excerpt = strip_tags(preg_replace("#<img.*>|<h4>.*</h4>|<h5>.*</h5>|<textarea>.*</textarea>#", "", $article["content"]));
            $excerpt = substr($excerpt, 0, 150);
            $excerpt = explode(" ", $excerpt);
            unset($excerpt[count($excerpt)-1]);
            $excerpt = implode(" ", $excerpt)." (...)";
            //display
            echo "<div class=\"card\"><div class=\"thumb\">";
            echo "<img src=\"{$img}\">";
            echo "</div><div class=\"snippet\">";
            echo "<h2>".htmlentities($article["title"])."</h2>";
            echo "<p>".$excerpt."</p>";
            echo "<a href=\"{$id}\">Lire le cours</a>";
            echo "</div></div><hr>";
        }
    }   
}

if(isset($_POST["lvl"])){
    all_article($_POST["lvl"]);
} else {
    die("<center><p>Error: no matching level found!</p></center>");
}
?>
<script>
//show article view
$(".card a").on("click", function(e){
    e.preventDefault;
    e.stopImmediatePropagation;

    var href = $(this).attr("href");

    window.location = "#"+href;
    history.replaceState("", "", "?a="+href);

    $(".comment_box").show();

    $.post("functions/load_one_article.php", {"article":href})
    .always(function(data){
        $(".article").css({"visibility":"articleViewVisible","bottom":"calc(0vh - 4px)"});
        $("body").css({"overflow":"hidden"});
        $(".article .data").html(data);
        $(".article .popup").empty();

        //load comments
        $.post("functions/load_comments.php", {"article":href})
        .always(function(data){
            $(".comment_list").empty().html(data);
        })
    })

    return false;
})

//close article view
$(".article .close").on("click", function(){
    $(".article").css({"visibility":"hidden", "bottom":"-100vh"});
    $("body").css({"overflow":"auto"});
    $(".article .data").empty();
    $(".comment_list").empty();
    history.replaceState("", "", "index.php");
})
</script>