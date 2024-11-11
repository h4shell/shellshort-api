<?php

$dbPath = "/var/www/html/";
$dbName = "db.sql";

class Database
{
    private $dbFile;
    private $db;
    private $dbPath;

    public function __construct($dbPath, $dbName)
    {
        $this->dbPath = $dbPath;
        $this->dbFile = $this->dbPath . $dbName;
        $this->initializeDatabase();
    }

    private function initializeDatabase()
    {
        try {
            // Crea (o apre) il database
            $this->db = new PDO("sqlite:" . $this->dbFile);
            // Imposta l'errore in modo che venga lanciata un'eccezione
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Crea la tabella "urls" se non esiste
            $sql = "CREATE TABLE IF NOT EXISTS urls (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                code VARCHAR(20) NOT NULL UNIQUE,
                url TEXT NOT NULL,
                statistic NUMBER DEFAULT 0
            )";

            // Esegui la query
            $this->db->exec($sql);
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }

    public function getUrl($code)
    {

        try {
            $sql = "SELECT url FROM urls WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->execute();
            $url = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($url === false) {
                return false;
            } else {
                return $url['url'];
            }
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }

    public function addUrl($code, $url)
    {
        try {
            $sql = "INSERT INTO urls (code, url) VALUES (:code, :url)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->bindParam(':url', $url);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }

    public function addVisit($code)
    {
        try {
            $sql = "UPDATE urls SET statistic = statistic + 1 WHERE code = :code";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':code', $code);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Errore: " . $e->getMessage();
        }
    }

    public function __destruct()
    {
        // Chiudi la connessione
        $this->db = null;
    }
}

$db = new Database($dbPath, $dbName);
