<?php
require_once __DIR__ . '/../config/database.php';

class Biography
{
    private $pdo;
    private $table = 'biography_sections';

    public function __construct()
    {
        $db = new Database('poet_site');
        $this->pdo = $db->getConnection();
    }

    public function getAllSections()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSection($sectionName)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE section_name = ?");
        $stmt->execute([$sectionName]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSection($sectionName, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE {$this->table} SET content = ? WHERE section_name = ?");
        return $stmt->execute([$content, $sectionName]);
    }

    public function addSection($sectionName, $content)
    {
        $stmt = $this->pdo->prepare("INSERT INTO {$this->table} (section_name, content) VALUES (?, ?)");
        return $stmt->execute([$sectionName, $content]);
    }
}
?>
