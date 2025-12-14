<?php
class Database {
    private $host = 'localhost';
    private $db = 'poet_site'; 
    private $user = 'root';
    private $pass = '';
    private $pdo;

    public function __construct($dbName = null) {
        $dsn = "mysql:host=$this->host";
        if ($dbName) {
            $dsn .= ";dbname=$dbName";
        }
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
