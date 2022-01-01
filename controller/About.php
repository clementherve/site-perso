<?php

namespace Blog;

require __DIR__ . "/../view/AboutHTML.php";

class About {

     public function __construct($router) {
        $this->router = $router;
        $this->htmlView = new AboutHTML();
    }

    public function showAboutPage() {
        $this->htmlView->showAboutPage();
    }
}