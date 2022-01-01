<?php
namespace Blog;

require_once __DIR__ . "/../vendor/autoload.php";
// require_once __DIR__ . "/../config.php";


class AboutHTML {

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader("template");
        $this->twig = new \Twig\Environment($this->loader);
    }
    

    public function showAboutPage() {
        echo $this->twig->render('about.twig', [
            'site_title' => $GLOBALS['config']["site_title"],
            'site_sub' => $GLOBALS['config']["site_sub"]
        ]);
    }
    
}