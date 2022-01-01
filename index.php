<?php
require __DIR__ . "/config.php";

if ($config["debug"] == true) {
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
}

require __DIR__ . "/vendor/autoload.php";

require __DIR__ . "/controller/Article.php";
require __DIR__ . "/controller/About.php";
require __DIR__ . "/controller/Projects.php";
require __DIR__ . "/controller/Error.php";
require __DIR__ . "/controller/Asset.php";
require __DIR__ . "/controller/Admin.php";


use CoffeeCode\Router\Router;

$router = new Router($GLOBALS['config']["site_addr"]);


$router->namespace("Blog");

// blog main routes
$router->get("/", "Article:getAllArticles");
$router->get("/articles/", "Article:getAllArticles");
$router->get("/articles/json/", "Article:getAllArticlesJson");
$router->get("/articles/tag/{tag}", "Article:filterArticlesByTag");
$router->get("/article/{slug}", "Article:getArticleBySlug");

$router->get("/about/", "About:showAboutPage");

$router->get("/projects/", "Projects:getAllProjects");


// admin routes
$router->get("/admin/", "Admin:showAdminPanel");
$router->post("/admin/login/", "Admin:login");
$router->get("/admin/logout/", "Admin:logout");

// article management routes
$router->post("/article/update/", "Article:updateArticle");
$router->get("/article/publish/{slug}", "Article:publishArticle");
$router->get("/article/unpublish/{slug}", "Article:unpublishArticle");
$router->get("/article/visibility/toggle/{slug}", "Article:toggleArticlePublishing");
$router->delete("/article/delete/{slug}", "Article:deleteArticle");

// files routes
$router->get("/public/css/{filename}", "Asset:showCSS");
$router->get("/public/js/{filename}", "Asset:showJS");
$router->get("/public/image/{filename}", "Asset:showImage");

// error page route
$router->get("/error/{code}/", "Error:showErrorPage");

$router->dispatch();

if ($router->error()) {
    $router->redirect("/error/{$router->error()}/");
}