<?php

namespace Blog;
use Exception;

require_once __DIR__ . "/../service/ArticleDatabase.php";


class PsqlDatabase implements ArticleDatabase {
    
    
    public function __construct(string $host, string $dbname, string $user, string $password) {
        $this->dbconn = pg_connect("host=".$host." dbname=".$dbname." user=".$user." password=".$password);
    }


    public function getAllArticles(bool $forceAll=false) : array {
        

        $query = <<< SQL
            select * from ((select distinct a.*, array_agg(t.tagname) as tags 
            from 
                articles a 
            join 
                tags t
            on a.slug = t.articleslug 
            group by a.id 
            order by a.date desc)
            union
            (select distinct *, ARRAY[]::text[] as tags from articles where slug not in (select distinct articleslug from tags))) sub
            order by sub.date desc
        SQL;

        $result = pg_query($query);
        
        $articles = [];
        while ($line = pg_fetch_assoc($result, null)) {
            $line['published'] = $line['published'] == "t";

            if (!$forceAll) {
                if (!$line['published']) continue;
                else {
                    $line['tags'] = preg_replace("/[{}]/", "", $line['tags']);
                    $line['tags'] = $line['tags'] == "" ? [] : explode(",", $line['tags']);
                    $articles[] = $line;
                }
                continue;
            }
            $line['tags'] = preg_replace("/[{}]/", "", $line['tags']);
            $line['tags'] = $line['tags'] == "" ? [] : explode(",", $line['tags']);
            
            $articles[] = $line;
        }
        pg_free_result($result);
        return $articles;
    }


    public function getArticleBySlug(string $slug) : array {
        $query = <<< SQL
            (select a.*, array_agg(t.tagname) as tags 
            from 
                articles a 
            join 
                tags t 
            on a.slug = t.articleslug
            where a.slug = $1
            group by a.id)
            union
            (select distinct *, ARRAY[]::text[] as tags from articles where slug not in (select distinct articleslug from tags) and slug = $1)
        SQL;
        pg_prepare($this->dbconn, "", $query);
        $result = pg_execute($this->dbconn, "", array($slug));
                
        if (pg_num_rows($result) != 1)
            throw new Exception("This article does not exists");
        
        $article = pg_fetch_array($result, null, PGSQL_ASSOC);
        $article['tags'] = preg_replace("/[{}]/", "", $article['tags']);
        $article['tags'] = $article['tags'] == "" ? [] : explode(",", $article['tags']);
        $article['published'] = $article['published'] == "t";
        pg_free_result($result);

        return $article;
    }


    public function getArticleById(string $id) : array {
        $query = <<< SQL
            (select a.*, array_agg(t.tagname) as tags 
            from 
                articles a 
            join 
                tags t 
            on a.slug = t.articleslug
            where a.id = $1
            group by a.id)
            union
            (select distinct *, ARRAY[]::text[] as tags from articles where slug not in (select distinct articleslug from tags) and id = $1)
        SQL;
        pg_prepare($this->dbconn, "", $query);
        $result = pg_execute($this->dbconn, "", array($id));
                
        if (pg_num_rows($result) != 1)
            throw new Exception("This article does not exists");
        
        $article = pg_fetch_array($result, null, PGSQL_ASSOC);
        $article['tags'] = preg_replace("/[{}]/", "", $article['tags']);
        $article['tags'] = $article['tags'] == "" ? [] : explode(",", $article['tags']);
        $article['published'] = $article['published'] == "t";
        pg_free_result($result);

        return $article;
    }


    private function createTag(string $slug, string $tagname) : bool {
        $query = <<< SQL
            insert into tags (articleslug, tagname) values ($1, $2)
        SQL;
        pg_prepare($this->dbconn, "", $query);
        $insertTagResponse = pg_execute($this->dbconn, "", array($slug, $tagname));
        return pg_affected_rows($insertTagResponse) == 1;
    }


    private function deleteTagsBySlug(string $slug) : bool {
        $query = <<< SQL
            delete from tags where articleslug = $1
        SQL;
        pg_prepare($this->dbconn, "", $query);
        $deleteTagResponse = pg_execute($this->dbconn, "", array($slug));
        return pg_affected_rows($deleteTagResponse) == 1;
    }


    private function createArticle(array $article) : bool {
        $query = <<< SQL
            insert into articles (title, content, slug, published) values ($1, $2, $3, $4);
        SQL;

        pg_prepare($this->dbconn, "", $query);
        $insertArticleResponse = pg_execute($this->dbconn, "", array(
            $article['title'],
            $article['content'],
            $article['slug'],
            "false"
        ));
        
        $article['tags'] = explode(",", $article['tags']);
        foreach($article['tags'] as $tag) {
            if (!$this->createTag($article['slug'], $tag)) return false;  
        }

        return pg_affected_rows($insertArticleResponse) == 1;
    }


    private function updateArticle(string $id, array $article) : bool {
        
        // check if article exists
        // if not, this will throw an exception
        $this->getArticleById($id);

        // else, we can update it
        $query = <<< SQL
            update articles set title = $1, content = $2, published = $3, slug = $4 where id = $5;
        SQL;
        $published = $article['published'] ? "true" : "false";

        pg_prepare($this->dbconn, "", $query);
        $result = pg_execute($this->dbconn, "", array(
            $article['title'],
            $article['content'],
            $published,
            $article['slug'],
            $id
        ));


        $this->deleteTagsBySlug($article['slug']);
        
        $article['tags'] = explode(",", $article['tags']);
        foreach($article['tags'] as $tag) {
            if (!$this->createTag($article['slug'], trim($tag))) return false;  
        }


        return pg_affected_rows($result) == 1;
    }

    public function updateArticleById(string $id, array $article) : bool {

        if (empty($id)) {
            // create new article
            return $this->createArticle($article);
        } else {
            try {
                // update existing article
                return $this->updateArticle($id, $article);
            } catch(Exception $e) {
                // hmmmmm
                return false;
            }
        }        
    }


    public function deleteArticleBySlug(string $slug) : bool {
        pg_prepare($this->dbconn, "", 'delete from articles where slug = $1;');
        return pg_affected_rows(pg_execute($this->dbconn, "", array($slug))) == 1;
    }
}
