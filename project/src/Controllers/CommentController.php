<?php
namespace src\Controllers;
use src\View\View;
use src\Services\Db;
use src\Models\Articles\Article;
use src\Models\Comments\Comment;

class CommentController {
    private $view;
    private $db;

    public function __construct() {
        $this -> view = new View;
        $this -> db = Db::getInstance();
    }

    public function edit($id) {
        $comment = Comment::getById($id);
        if (!$comment) {
            throw new \Exception('Comment not found');
        }
        $this -> view -> renderHtml('comments/edit', ['comment' => $comment]);
    }
    public function update($id) {
        $comment = Comment::getById($id);
        $comment -> text = $_POST['text'];
        $comment -> save();

        $commentId = $comment -> getID();
        return header('Location:http://localhost/Project/www/article/'
        . $comment -> getArticleId() . '#comment' . $commentId);
    }

    public function delete($id) {
        $comment = Comment::getById($id);
        if (!$comment) {
            throw new \Exception('Comment not found');
        }
        
        $articleId = $comment->getArticleId();
        $comment->delete();
        
        return header('Location:http://localhost/Project/www/article/' . $articleId);
    }
}