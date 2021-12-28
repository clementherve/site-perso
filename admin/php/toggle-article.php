<?php
    if (!isset($_GET['id'])) {
        die("Missing data");
    }
    include("../../php/article.php");
    $article = new article();
    $article->togglePublishedStatus("../../articles/".$_GET['id'].".json");
    die("Ok !");
