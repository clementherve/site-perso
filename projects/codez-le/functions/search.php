<?php

require "push_stat.php";

//start if a query is sent
if(isset($_POST["q"])){
    
    //secure user input
    $input = transliterator_transliterate("LATIN-ASCII", strip_tags(strtolower($_POST["q"])));
    $input = trim($input);
    $user_input = $input;
    $input = preg_replace("#['-]#", " ", $input);
    $input = preg_replace("#[\#\"(){}?!:/\.&~,@~$=+0-9_]#", "", $input);
    
    //create an array
    $input = explode(" ", $input);
    foreach($input as $word){
        if(strlen($word) > 3){
            $query[] = $word;
        }
    }
    
    //If the query passsed the tests launch the research
    if(isset($query)){
        $as = glob("../articles/*.json");
        
        for($i=0; $i<count($as); $i++){
            
            $a = $as[$i];
            $path = $a;
            $article = json_decode(file_get_contents($a), true);

            if($path != "../articles/index.json" and $article["published"]){
                $title = $article["title"];
                $content = $article["content"];
                foreach($query as $word){
                    //search the content
                    if(preg_match("#".$word."#", $content)){
                        if(isset($res[$path])){
                            $res[$path] += preg_match_all("#".$word."#", $content);
                        } else {
                            $res[$path] = preg_match_all("#".$word."#", $content);
                        }
                    }
                    //search the title
                    if(preg_match("#".$word."#", $title)){
                        if(isset($res[$path])){
                            $res[$path] += preg_match_all("#".$word."#", $title);
                        } else {
                            $res[$path] = preg_match_all("#".$word."#", $title);
                        }
                    }
                }
            }            
        }
        
        if(isset($res)){
            
            arsort($res, SORT_NATURAL);
            $nbr_res = count($res);
            $path = array_keys($res);
            
            echo "<p id=\"res\">Votre recherche sur <b>{$user_input}</b> a donné les {$nbr_res} suivants :</p>";
           
            foreach($res as $path => $nbr){
                
                $article = json_decode(file_get_contents($path), true);
            
                $title = $article["title"];
                $content = $article["content"];

                //img
                preg_match("#<img src=\"(.*)\"#", $content, $img);
                if(isset($img[1])){
                    $img = $img[1];
                } else {
                    $img = "img/default.jpg";
                }

                $exerpt = strip_tags(preg_replace("#<h3>.*</h3>|<img.*>|<textarea>.*</textarea>#", "", $content));
                $exerpt = substr($exerpt, 0, 150);
                $exerpt = explode(" ", $exerpt);
                unset($exerpt[count($exerpt)-1]);
                $exerpt = implode(" ", $exerpt)." (...)";
                
                $article = preg_replace("#\.\./articles/#", "", $path);
                
                echo "<div class=\"card\"><div class=\"thumb\">";
                echo "<img src=\"{$img}\">";
                echo "</div><div class=\"snippet\">";
                echo "<h2>".$title."</h2>";
                echo "<p>".$exerpt."</p>";
                echo "<a href=\"{$article}\">Lire le cours</a>";
                echo "</div></div><hr>";
            }
        } else {
            echo "<p id=\"res\">Aucun résultat :(</p>";
        }
        
        
        
    } else {
        echo "<p id=\"res\">Aucun résultat :(</p>";
    }
}
?>

<script>
    
    //show article view
    $(".card a").on("click", function(e){
        e.preventDefault;
        e.stopImmediatePropagation;
        
        var href = $(this).attr("href");
        
        $.post("functions/load_one_article.php", {"article":href})
        .always(function(data){
            $(".article").css({"visibility":"articleViewVisible","bottom":"0vh"});
            $("body").css({"overflow":"hidden"});
            $(".article .data").html(data);
        })
        
        return false;
    })
    
</script>