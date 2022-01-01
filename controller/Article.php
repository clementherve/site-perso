<?php

namespace Blog;

if (session_status() == PHP_SESSION_NONE) session_start();


require __DIR__ . "/../view/ArticleHTML.php";
require __DIR__ . "/../view/ApiJSON.php";
require __DIR__ . "/../service/ArticleManager.php";
require __DIR__ . "/../service/FileDatabase.php";
require __DIR__ . "/../service/PsqlDatabase.php";
require_once __DIR__ . "/../vendor/autoload.php";


class Article {

    public function __construct(object $router) {
        $this->router = $router;
        $this->htmlView = new ArticleHTML();
        $this->jsonView = new ApiJSON();
        // $this->articleManager = new ArticleManager(new FileDatabase("data/articles/"));
        $this->articleManager = new ArticleManager(new PsqlDatabase(
            $GLOBALS['config']["host"],
            $GLOBALS['config']["dbname"],
            $GLOBALS['config']["user"],
            $GLOBALS['config']["password"]
        ));
    }

    
    public function getAllArticles() : void {
        $this->htmlView->showArticles($this->articleManager->getAllArticles());
    }


    public function getAllArticlesJson() : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            header("Content-Type: application/json");
            echo json_encode($this->articleManager->getAllArticles(true));
        }
    }


    public function filterArticlesByTag(array $args) : void {
        $this->htmlView->showArticles($this->articleManager->filterArticlesByTag($args["tag"]));
    }


    public function getArticleBySlug(array $args) : void {
        $this->htmlView->showArticle($this->articleManager->getArticleBySlug($args['slug']));
    }

    
    public function updateArticle(array $args) : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            try {
                $this->articleManager->updateArticle($args);
                $this->jsonView->ok("Article updated");
            } catch (Exception $e) {
                $this->jsonView->failed($e->getMessage());
            }
        } 
    }


    public function publishArticle(array $args) : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            try {
                $this->articleManager->publishArticle($args['slug']);
                $this->jsonView->ok("Article published");
            } catch (Exception $e) {
                $this->jsonView->failed($e->getMessage());
            }
        }
    }


    public function unpublishArticle(array $args) : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            try {
                $this->articleManager->unpublishArticle($args['slug']);
                $this->jsonView->ok("Article unpublished");   
            } catch (Exception $e) {
                $this->jsonView->failed($e->getMessage());
            }
        }
    }


    public function toggleArticlePublishing(array $args) : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            try {
                $this->articleManager->toggleArticlePublishing($args['slug']);
                $this->jsonView->ok("Article published");
            } catch (Exception $e) {
                $this->jsonView->failed($e->getMessage());
            }
        }
    }


    public function deleteArticle(array $args) : void {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false)
            $this->jsonView->failed("You must be logged in", "401 Unauthorized");
        else {
            try {
                $this->articleManager->deleteArticleBySlug($args['slug']);
                $this->jsonView->ok("Article deleted");
            } catch(Exception $e) {
                $this->jsonView->failed($e);
            }
        }
    }
}