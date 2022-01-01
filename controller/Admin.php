<?php

namespace Blog;


require __DIR__ . "/../view/AdminHTML.php";



class Admin {

     public function __construct($router) {
        $this->router = $router;
        $this->htmlView = new AdminHTML();
    }


    public function showAdminPanel() : void {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $this->htmlView->showAdminPage();
    }

    public function login(array $args) : void {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (isset($args['login']) && isset($args['password'])) {
            if ($args['login'] == $GLOBALS['config']['admin_user'] && $args['password'] == $GLOBALS['config']['admin_password']) {
                $_SESSION['loggedin'] = true;
                $this->router->redirect("/admin/");
            }
        }

        header("HTTP/1.1 401 Unauthorized");
        $this->router->redirect("/admin/", [
            "code" => 401,
        ]);
    }

    public function logout() : void {
        if (session_status() == PHP_SESSION_NONE) session_start();
        $_SESSION['loggedin'] = false;
        $this->router->redirect("/admin/");
    }
}