<?php

namespace Blog;




class Asset {

     public function __construct($router) {
        $this->router = $router;
    }


    private function showFile(array $filename, string $contentType, string $dir, array $authorized_ext) {
        $args = explode(".", $filename['filename']);
        
        if (count($args) != 2) {
            $router->redirect("/error/401");
            return;
        }

        // check if file extenson is in the list of allowed extensions
        $ext = strtolower($args[1]);
        if (!in_array($ext, $authorized_ext)) {
            $router->redirect("/error/403");
            return;
        } 

        header("Content-Type: " . $contentType . "/" . $ext);
        readfile("public/" . $dir . "/" . $filename['filename']);
    }


    public function showImage($filename) {
        $this->showFile($filename, "image", "image", ['png', 'jpg', 'jpeg', 'gif']);
    }

    public function showCSS($filename) {
        $this->showFile($filename, "text", "css", ['css']);
    }

    public function showJS($filename) {
        $this->showFile($filename, "text", "js", ['js']);
    }
}