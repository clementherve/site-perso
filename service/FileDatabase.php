<?php

namespace Blog;
use Exception;

require __DIR__ . "/../service/ArticleDatabase.php";


class FileDatabase implements ArticleDatabase {

    
    public function __construct(string $basePath) {
        $this->basePath = $basePath;
    }


    private function getArticleJson(string $path) {
        return json_decode(file_get_contents($path), true);
    }


    private function articleExists(string $id) : bool {
        return file_exists($this->basePath . $id . ".json");
    }

    
    public function getAllArticles($all=false) : array {
        $path = $this->basePath . "*.json";
        $list = glob($path, GLOB_NOSORT);
        $sortedList = [];

        foreach ($list as $path) {
            $sortedList[filemtime($path)] = $path;
        }
        
        krsort($sortedList);


        $sortedArticles = [];
        foreach ($sortedList as $article) {
            
            $json = $this->getArticleJson($article);
            if ($all == false) {                
                if ($json['is-draft'] == false) {
                    $sortedArticles[] = $json;
                }
            } else {
                $sortedArticles[] = $json;
            }
            
        }
        
        return $sortedArticles;
    }


    public function getArticleBySlug(string $slug) : array{
        if (!$this->articleExists($slug)) {
            throw new Exception('Article does not exists');
        }
        return $this->getArticleJson($this->basePath . $slug . ".json");
    }


    public function createArticle(array $article) : bool {
        $path = $this->basePath . $article['id'] . ".json";
        return file_put_contents($path, json_encode($article));
    }


    public function updateArticleById(string $id, array $article) : bool {
        return file_put_contents($this->basePath . $id . ".json", json_encode($article));
    }


    public function deleteArticleBySlug(string $id) : bool{
        $path = $this->basePath . $id . ".json";
        return file_exists($path) ? unlink($path) : false;
    }
}