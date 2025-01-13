<?php
require "Database.php";
class login extends Database
{

    public function inloggen($data)
    {
        $error = '';
        $username = trim($data['gebruikersnaam']);
        $password = trim($data['wachtwoord']);

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

                    header('Location: index.php');
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
?>
