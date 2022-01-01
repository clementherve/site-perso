<?php

namespace Blog;

require __DIR__ . "/../view/ProjectsHTML.php";
require __DIR__ . "/../service/ProjectManager.php";

class Projects {

    public function __construct($router) {
        $this->router = $router;
        $this->projectManager = new ProjectManager("data/projects/");
        $this->htmlView = new ProjectsHTML();
    }

    public function getAllProjects() {
        // $this->projectManager->getAllProjects()
        $this->htmlView->showAllProjects($this->projectManager->getAllGithubProjects());
        
    }
}