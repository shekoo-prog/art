<?php
require_once __DIR__ . '/../config/database.php';

class Poem
{
    private $pdo;
    private $table = 'poems';

    public function __construct()
    {
        $db = new Database('poet_site');
        $this->pdo = $db->getConnection();
    }

    public function getAllPoems()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPoem($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPoem($title, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (title, content) VALUES (?, ?)");
        return $stmt->execute([$title, $content]);
    }

    public function updatePoem($id, $title, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET title = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $id]);
    }

    public function deletePoem($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getLikesCount($poemId)
    {
        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM likes WHERE poem_id = ?');
        $stmt->execute([$poemId]);
        return $stmt->fetchColumn();
    }

    public function incrementViews($id)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET views = views + 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
