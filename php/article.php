<?php


class article {


    public function createExcerpt($text, $size=400) {
        $text = strip_tags($text);
        if( strlen($text) > $size ){
            $text = substr($text, 0, $size);
            $text = explode(' ', $text);
            unset($text[count($text)-1]);

            return implode(' ', $text).' (...)';
        } else {
            return $text;
        }
    }


    protected function createTags($tags) {
        $tagsHTML = "";
        foreach($tags as $tag) {
            $tagsHTML .= "<a href='/tag/".$tag."/'>#".$tag."</a> ";
        }
        return $tagsHTML;
    }


    private function createArticleCard($article) {
        return "<div class='article'>
    	   <a href='/a/".$article['ID']."/'><h3>".$article['title']."</h3></a>
    		<div class='tag-box'>
            ".($this->createTags($article['tags']))."
    		</div>
    		<p>".($this->createExcerpt($article['content']))."</p>
    	</div>";
    }


    public function getArticleJson($path) {
        return json_decode(file_get_contents($path), true);
    }


    public function getArticleList($path="articles/*.json", $sortbydate=false) {
        $list = glob($path, GLOB_NOSORT);
        $sortedList = [];

        foreach ($list as $path) {
            $sortedList[filemtime($path)] = $path;
        }
        
        if ($sortbydate) {
            krsort($sortedList);
        }

        return $sortedList;
    }


    private function hasTag($tags, $tag) {
        $tags = $tags['tags'];
        foreach($tags as $t) {
            if($t == $tag) {
                return true;
            }
        }
    }

    public function isDraft($id) {
        $article = $this->getArticleJson("./articles/".$id.".json");
        return $article["is-draft"];
    }


    public function isIdValid($id) {
        return file_exists("./articles/".$id.".json");
    }

    public function togglePublishedStatus($path) {
        $a = $this->getArticleJson($path);
        $a["is-draft"] = !$a["is-draft"];
        $this->saveArticle($path, $a);
    }


    public function showArticles($filterByTag=false, $filterTag="") {
        $list = $this -> getArticleList("articles/*.json", true);
        $articlesHTML = "";

        foreach($list as $path) {
            $article = $this->getArticleJson($path);

            if($article['is-draft'] == "false"){
                if ($filterByTag) {
                    if($this->hasTag($article, $filterTag)){
                        $articlesHTML .= $this->createArticleCard($article);
                    }
                } else {
                    $articlesHTML .= $this->createArticleCard($article);
                }
            }
        }
        echo $articlesHTML;
    }


    public function showArticle($id) {
        $article = $this->getArticleJson("articles/".$id.".json");
        echo "<h2>".$article['title']."</h2>
        <div class='tag-box'>
        	".($this->createTags($article['tags']))."
        </div>".$article['content'];
    }




    public function makeID($string){
		$string = transliterator_transliterate('Latin-ASCII', $string);
		$string = preg_replace("# #", "-", $string);
		$string = preg_replace("#['|~,;:/!*^+=)_`(]#", "", $string);
		$string = strtolower($string);
		return $string;
	}


    public function saveArticle($path, $json) {
        // $path = '//articles/'.$json['ID'].'.json';

        if( file_put_contents($path, json_encode($json)) ){
            die("Saved article");
        } else {
            die("Error while saving the article");
        }
    }


    public function deleteArticle($path) {
        
        // $path = "//articles/".$id.".json";
        if(file_exists($path)){
            if(unlink($path)){
                die("{'status':'ok'}");
            } else {
                die("{'status':'permission-error'}");
            }
        } else {
            die("{'status':'file-doesnt-exists'}");
        }
    }

}

?>
