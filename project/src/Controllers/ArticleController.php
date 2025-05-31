<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;

class ArticleController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;  
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
            if ($article == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('article/show', ['article'=>$article]);
    }

    public function edit($id){
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }

    public function update($id){
        $article = Article::getById($id);
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->save();
        return header('Location:http://localhost/project/www/article/'.$article->getId());
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }

    public function store(){
        $article = new Article;
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        return header('Location:http://localhost/project/www/index.php');
    }

    public function delete(int $id){
        $article = Article::getById($id);
        Comment::deleteByArticleId($id);
        $article->delete();
        return header('Location:http://localhost/project/www/index.php');
    }
    public function comments(int $id) {
        $comment = new Comment;

        $comment -> text = $_POST['text'];
        $comment -> authorId = 1;
        $comment -> articleId = $id;
        $comment -> save();

        $commentId = $comment -> getID();
        
        return header('Location:http://localhost/Project/www/article/' . $id . '#comment' . $commentId);
    }
}