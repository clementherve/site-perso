<?php
namespace Blog;

require_once __DIR__ . "/../vendor/autoload.php";

use League\CommonMark\CommonMarkConverter;

class ArticleHTML {

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader("template");
        $this->twig = new \Twig\Environment($this->loader);
    }
    

    public function showArticles($articles) {
        for($i=0; $i<count($articles); $i++) {
            $articles[$i]['excerpt'] = $this->createExcerpt($articles[$i]['content']);
        }
        echo $this->twig->render('articles.twig', [
            'articles' => $articles,
            'site_title' => $GLOBALS['config']["site_title"],
            'site_sub' => $GLOBALS['config']["site_sub"]
        ]);
    }


    public function showArticle($article) {

        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ]);

        echo $this->twig->render('article.twig', [
            'title' => $article['title'],
            'tags' => $article['tags'],
            'content' => $converter->convertToHtml($article['content']),
            'site_title' => $GLOBALS['config']["site_title"],
            'site_sub' => $GLOBALS['config']["site_sub"]
        ]);
    }


    
    private function createExcerpt($text, $size=400) {
        $text = strip_tags($text);
        if( strlen($text) > $size ){
            $text = substr($text, 0, $size);
            $text = explode(' ', $text);
            unset($text[count($text)-1]);
            
            return implode(' ', $text).' (...)';
        } else {
            return $text;
        }
    }

    
}