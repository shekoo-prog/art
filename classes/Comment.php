<?php
require_once __DIR__ . '/../config/database.php';

class Comment {
    private $pdo;
    private $table = 'comments';

    public function __construct() {
        $db = new Database('poet_site');
        $this->pdo = $db->getConnection();
    }

    public function getComments($poemId) {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE poem_id = ? ORDER BY created_at DESC");
        $stmt->execute([$poemId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($poemId, $comment) {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (poem_id, comment) VALUES (?, ?)");
        return $stmt->execute([$poemId, $comment]);
    }

    public function getCommentsCount($poemId) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE poem_id = ?");
        $stmt->execute([$poemId]);
        return $stmt->fetchColumn();
    }
}
