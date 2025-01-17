<?php

require_once "./classes/Database.php";
class Film extends Database{
    
    public function addFilm(){
                

        try {
      
            $sql = "INSERT INTO films (titel, omschrijving, release_datum, genre, duur, poster_url)
                    VALUES (:titel, :omschrijving, :release_datum, :genre, :duur, :poster_url)";

          
            $stmt = $this->conn->prepare($sql);

           
            $stmt->bindParam(':titel', $_POST['titel'], PDO::PARAM_STR);
            $stmt->bindParam(':omschrijving', $_POST['omschrijving'], PDO::PARAM_STR);
            $stmt->bindParam(':release_datum', $_POST['release_datum'], PDO::PARAM_STR);
            $stmt->bindParam(':genre', $_POST['genre'], PDO::PARAM_STR);
            $stmt->bindParam(':duur', $_POST['duur'], PDO::PARAM_INT);
            $stmt->bindParam(':poster_url', $_POST['poster_url'], PDO::PARAM_STR);

            // Voer de query uit
            $stmt->execute();

            echo "<p>Film succesvol toegevoegd!</p>";
        } catch (PDOException $e) {
            // Foutafhandeling
            echo "<p>Fout bij het toevoegen van de film: " . $e->getMessage() . "</p>";
        }

    }


    public function getAllFilms()
    {
        $sql = "SELECT * FROM films";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFilmById($id)
    {
        $sql = "SELECT * FROM films WHERE film_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteFilm($id){
                

        try {
      
            $sql = "DELETE FROM films WHERE film_id = :film_id";
    
    
          
            $stmt = $this->conn->prepare($sql);
    
           
            $stmt->bindParam(':film_id', $id);
        
    
        
            $stmt->execute();
    
            echo "<p>Film succesvol deletet!</p>";
        } catch (PDOException $e) {
            echo "<p>Fout bij het toevoegen van de film: " . $e->getMessage() . "</p>";
        }
    }

    public function bewerkfilms($id)
{
    try {
        // Query aanpassen naar juiste kolomnamen
        // UPDATE `films` SET `poster_url` = 'kljlf;dsa' WHERE `films`.`film_id` = 18; 
        $sql = "UPDATE films 
                SET titel = :titel, 
                    omschrijving = :omschrijving, 
                    release_datum = :release_datum, 
                    genre = :genre, 
                    duur = :duur, 
                    poster_url = :poster_url 
                WHERE film_id = :film_id";

        // Bereid de query voor
        $stmt = $this->conn->prepare($sql);

        // Bind de parameters met waarden uit het formulier
        $stmt->bindParam(':titel', $_POST['titel'], PDO::PARAM_STR);
        $stmt->bindParam(':omschrijving', $_POST['omschrijving'], PDO::PARAM_STR);
        $stmt->bindParam(':release_datum', $_POST['release_datum'], PDO::PARAM_STR);
        $stmt->bindParam(':genre', $_POST['genre'], PDO::PARAM_STR);
        $stmt->bindParam(':duur', $_POST['duur'], PDO::PARAM_INT);
        $stmt->bindParam(':poster_url', $_POST['poster_url'], PDO::PARAM_STR);
        $stmt->bindParam(':film_id', $id, PDO::PARAM_INT);

        // Voer de query uit
        $stmt->execute();

        echo "<p>Film succesvol bewerkt!</p>";
    } catch (PDOException $e) {
        echo "<p>Fout bij het bewerken van de film: " . $e->getMessage() . "</p>";
    }
}


}
?>

<?php
/*class newfilm extends Database
{
    public function pushallfilms()
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
*/


?>



