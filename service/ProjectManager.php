<?php

namespace Blog;

class ProjectManager {

    public function __construct() {
        $this->basePath = __DIR__ . "/../data/project/";
    }

    public function getAllProjects() : array {
        $path = $this->basePath . "*";
        $folders = glob($path, GLOB_NOSORT);

        $projects = [];
        
        foreach ($folders as $folder) {
            if ($folder != "." && $folder != "..") {
                $path = $folder . "/readme.";
                $readme = file_exists($path . "txt") ? file_get_contents($path . "txt") : "Aucune description trouvée";
                $readme = file_exists($path . "md") ? file_get_contents($path . "md") : $readme;

                $projects[] = array(
                    "url" => "/project/" . basename($folder),
                    "name" => basename($folder),
                    "readme" => $readme
                );
            }
        }

        return $projects;
    }


    public function getAllGithubProjects() : array {
        
        $gh_username = $GLOBALS['config']['github_username'];
        $url = "https://api.github.com/users/" . $gh_username . "/repos";
        
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)'); 
        $projects = json_decode(file_get_contents($url, False), true);

        foreach($projects as $i => $project) {
            $projects[$i]['url'] = "https://github.com/" . $gh_username . "/" . $project['name'];
            $projects[$i]['name'] = $project['name'];
            $projects[$i]['readme'] = $project['description'];
        }
        
        return $projects;
    }
}