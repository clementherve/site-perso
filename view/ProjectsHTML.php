<?php
namespace Blog;

require_once __DIR__ . "/../vendor/autoload.php";

class ProjectsHTML {

    public function __construct() {
        $this->loader = new \Twig\Loader\FilesystemLoader("template");
        $this->twig = new \Twig\Environment($this->loader);

    }
    

    public function showAllProjects($projects) {
        echo $this->twig->render('projects.twig', [
            'projects' => $projects,
            'site_title' => $GLOBALS['config']["site_title"],
            'site_sub' => $GLOBALS['config']["site_sub"]
        ]);
    }
    
}