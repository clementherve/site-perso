<?php
namespace Blog;

require_once __DIR__ . "/../vendor/autoload.php";

class ErrorHTML {

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader("template");
        $this->twig = new \Twig\Environment($this->loader);
    }
    

    public function showErrorPage($code) {
        if (!is_numeric($code))
            $code = 404;
        
        http_response_code($code);
        echo $this->twig->render('error.twig', ['code' => $code]);
    }
    
}