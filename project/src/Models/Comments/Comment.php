<?php 
namespace src\Models\Comments;
use src\Models\ActiveRecordEntity;
use src\Models\Articles\Article;
use src\Models\Users\User;
use src\Services\Db;

class Comment extends ActiveRecordEntity {
    protected $id;
    protected $authorId;
    protected $articleId;
    protected $text;
    protected $createdAt;

    public static function getTableName(): string {
        return 'comments';
    }
    public static function getByArticleId(int $articleId) {
        $all = self::findAll();

        $res = array_filter($all, fn (Comment $comment) => 
            $comment -> getArticleId() === $articleId);

        return array_values($res);
    }

    public function getAuthor() {
        return User::getById($this -> authorId);
    }
    public function getAuthorId() {
        return $this -> authorId;
    }
    public function getArticleId() {
        return $this -> articleId;
    }
    public function getArticle() {
        return Article::getById($this -> articleId);
    }
    public function getText() {
        return $this -> text;
    }
    public function getCreatedAt() {
        return $this -> createdAt;
    }
    public function setAuthorId(int $authorId) {
        $this -> authorId = $authorId;
    }
    public function setArticleId(int $articleId) {
        $this -> articleId = $articleId;
    }
    public function setText(string $text) {
        $this -> text = $text;
    }
    public function setCreatedAt(string $createdAt) {
        $this -> createdAt = $createdAt;
    }

    public static function deleteByArticleId($articleId) {
        $db = Db::getInstance();
        $sql = 'DELETE FROM comments WHERE article_id = :article_id';
        $db->query($sql, [':article_id' => $articleId]);
    }
}