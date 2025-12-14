<?php
require_once __DIR__ . '/../config/database.php';

class Like {
    private $pdo;
    private $table = 'likes';

    public function __construct() {
        $db = new Database('poet_site');
        $this->pdo = $db->getConnection();
    }

    public function addLike($poemId, $ip) {
        $stmt = $this->pdo->prepare("INSERT IGNORE INTO {$this->table} (poem_id, ip) VALUES (?, ?);");
        return $stmt->execute([$poemId, $ip]);
    }

    public function removeLike($poemId, $ip) {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE poem_id = ? AND ip = ?");
        return $stmt->execute([$poemId, $ip]);
    }

    public function hasLiked($poemId, $ip) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM {$this->table} WHERE poem_id = ? AND ip = ?");
        $stmt->execute([$poemId, $ip]);
        return $stmt->fetchColumn() > 0;
    }
}
?>
