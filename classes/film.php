<?php
require "Database.php";
class Film extends Database
{
    



    public function getAllFilms()
    {
        $sql = "SELECT * FROM films";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilmById($id)
    {
        $sql = "SELECT * FROM films WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>