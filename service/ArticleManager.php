<?php

namespace Blog;

use Exception;

class ArticleManager {

    public function __construct(object $db) {
        $this->db = $db;
    }


    public function getAllArticles($all=false) : array {
        return $this->db->getAllArticles($all);
    }


    public function getArticleBySlug(string $id) : array{
        return $this->db->getArticleBySlug($id);
    }


    public function createArticle(array $article) : bool {
        $article['published'] = (bool) $article['published'];
        $article['slug'] = empty($article['slug']) ? $this->createArticleSlug($article['title']) : $article['slug'];
        $article['date'] = date('Y-m-d H:i');

        return $this->db->createArticle($article);
    }


    public function deleteArticleBySlug(string $slug) : void {
        $this->db->deleteArticleBySlug($slug);
    }


    public function updateArticle(array $article) : bool {
        $id = $article['id'];
        return $this->db->updateArticleById($id, $article);
    }


    public function isArticlePublished(string $slug) : bool {
        return $this->db->getArticleByID($slug)["published"];
    }


    public function articleHasTag(string $slug, string $tag) : bool {
        $tags = $this->db->getArticleBySlug($slug)['tags'];
        foreach($tags as $t) {
            if ($t == $tag) return true;
        }
        return false;
    }


    public function filterArticlesByTag(string $tag) : array{
        $articles = $this->db->getAllArticles();
        $filteredArticles = [];
        foreach ($articles as $article) {
            if ($this->articleHasTag($article['slug'], $tag)) {
                $filteredArticles[] = $article;
            }
        }
        return $filteredArticles;
    }


    public function createArticleSlug(string $title) : string {
		$string = transliterator_transliterate('Latin-ASCII', $title);
		$string = preg_replace("# #", "-", $string);
		$string = preg_replace("#['|~,;:/!*^+=)_`(]#", "", $string);
		$string = strtolower($string);
		return $string;
	}


    public function publishArticle(string $slug) : bool{
        $article = $this->db->getArticleBySlug($slug);
        $article["published"] = true;
        return $this->db->updateArticleById($slug, $article);
    }


    public function unpublishArticle(string $slug) : bool {
        $article = $this->db->getArticleBySlug($slug);
        $article["published"] = false;
        return $this->db->updateArticleById($slug, $article);
    }


    public function toggleArticlePublishing(string $slug) : bool {
        $article = $this->db->getArticleBySlug($slug);
        $article["published"] = !$article["published"];
        if ($this->db->updateArticleById($article['id'], $article)) {
            return $article['published'];
        } else {
            throw new Exception("Article not updated");
        }
    }
}