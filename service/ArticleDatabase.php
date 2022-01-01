<?php

namespace Blog;

interface ArticleDatabase {
    function getAllArticles();
    function getArticleBySlug(string $id);
    function updateArticleById(string $id, array $article);
    function deleteArticleBySlug(string $id);
}