<?php

namespace Blog;
require __DIR__ . "/../view/ErrorHTML.php";

class Error {

     public function __construct($router) {
        $this->router = $router;
        $this->htmlView = new ErrorHTML();
    }

    public function showErrorPage($code) {
        $this->htmlView->showErrorPage($code);
    }
}