<?php
namespace Blog;


require_once __DIR__ . "/../vendor/autoload.php";

class AdminHTML {

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader("template");
        $this->twig = new \Twig\Environment($this->loader);
    }
    

    public function showAdminPage() : void {
        if (session_status() == PHP_SESSION_NONE) session_start();
        echo $this->twig->render('admin.twig', [
            'loggedin' => isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true,
        ]);
    }
    
}