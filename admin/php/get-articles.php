<?php
    include("../../php/article.php");
    $article = new article();

    $list = $article->getArticleList("../../articles/*.json");

    $response = [];
    foreach($list as $path) {
        $a = $article->getArticleJson($path);
        $entry["title"] = $a["title"];
        $entry["excerpt"] = $article->createExcerpt($a["content"], 150);
        $entry["content"] = $a["content"];
        $entry["tags"] = implode(", ", $a["tags"]);
        $entry["id"] = $a["ID"];
        $entry["status"] = $a["is-draft"];

        $response[] = $entry;
    }

    echo json_encode($response);

?>