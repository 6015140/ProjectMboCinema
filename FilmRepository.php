<?php

require_once 'Film.php';

class FilmRepository {
    private $pdo;

    public function __construct($host, $dbName, $username, $password) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Fout bij verbinden met de database: " . $e->getMessage());
        }
    }

    public function getAllFilms() {
        $stmt = $this->pdo->query("SELECT * FROM films");
        $films = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $films[] = new Film(
                $row['film_id'],
                $row['titel'],
                $row['omschrijving'],
                $row['release_datum'],
                $row['genre'],
                $row['duur'],
                $row['poster_url']
            );
        }
        return $films;
    }
}
?>
