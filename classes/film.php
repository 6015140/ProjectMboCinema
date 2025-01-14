<?php
require "Database.php";
class Film extends Database 
{
    
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
        $sql = "SELECT * FROM films WHERE id = :id";
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



