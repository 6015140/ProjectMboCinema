<?php
require "./classes/Database.php";	
class User extends Database{

public function register($user)
{
        $username = trim($user['gebruikersnaam']);
        $password = trim($user['wachtwoord']);
        $mail = trim($user['mail']);
        $leeftijd = trim($user['leeftijd']);
        $key_vraag = trim($user['key_vraag']);
        $key_antwoord = trim($user['key_antwoord']);

        if (empty($username) || empty($password) || empty($mail) || empty($leeftijd) || empty($key_vraag) || empty($key_antwoord)) {
            echo "Alle velden zijn verplicht.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $hashed_key_antwoord = password_hash($key_antwoord, PASSWORD_DEFAULT);

            $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, mail, leeftijd, key_vraag, key_antwoord) 
                    VALUES (:gebruikersnaam, :wachtwoord, :mail, :leeftijd, :key_vraag, :key_antwoord)";

            $stmt = $this->conn->prepare($sql);

    
            $stmt->bindParam(':gebruikersnaam', $username, PDO::PARAM_STR);
            $stmt->bindParam(':wachtwoord', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_INT);
            $stmt->bindParam(':key_vraag', $key_vraag, PDO::PARAM_STR);
            $stmt->bindParam(':key_antwoord', $hashed_key_antwoord, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Gebruiker succesvol geregistreerd.";
            } else {
                echo "Er is een fout opgetreden bij het registreren van de gebruiker: " . htmlspecialchars($stmt->errorInfo()[2]);
            }

        }
    
}

public function inloggen($data)
    {
        $error = '';
        $username = trim($data['gebruikers']);
        $password = trim($data['password']);

        if (empty($username) || empty($password)) {
            $error = "Gebruikersnaam en wachtwoord zijn verplicht.";
        } else {
            $conn = $this->conn;	


            $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
            $stmt->bindParam(':gebruikersnaam', $username, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if (password_verify($password, $result['wachtwoord'])) {
                    session_start();
                    $_SESSION['user_id'] = $result['id'];
                    $_SESSION['gebruikersnaam'] = $result['gebruikersnaam'];
                    $_SESSION['rol'] = $result['rol'];

                    header('Location: home.php');
                    exit;
                } else {
                    $error = "Ongeldige gebruikersnaam of wachtwoord.";
                }
            } else {
                $error = "Ongeldige gebruikersnaam of wachtwoord.";
            }
        }

        return $error;
    }
}