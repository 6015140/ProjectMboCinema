<?php

function login($data)
{
    $error = '';
    $username = '';
    $username = trim($data['gebruikersnaam']);
    $password = trim($data['wachtwoord']);

    if (empty($username) || empty($password)) {
        $error = "Gebruikersnaam en wachtwoord zijn verplicht.";
    } else {
        
        require "Database.php";  

      
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
?>



<?php

function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "Database.php";  


        $username = trim($_POST['gebruikersnaam']);
        $password = trim($_POST['wachtwoord']);
        $mail = trim($_POST['mail']);
        $leeftijd = trim($_POST['leeftijd']);
        $key_vraag = trim($_POST['key_vraag']);
        $key_antwoord = trim($_POST['key_antwoord']);

        if (empty($username) || empty($password) || empty($mail) || empty($leeftijd) || empty($key_vraag) || empty($key_antwoord)) {
            echo "Alle velden zijn verplicht.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $hashed_key_antwoord = password_hash($key_antwoord, PASSWORD_DEFAULT);

          
            $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, mail, leeftijd, key_vraag, key_antwoord) 
                    VALUES (:gebruikersnaam, :wachtwoord, :mail, :leeftijd, :key_vraag, :key_antwoord)";

            $stmt = $conn->prepare($sql);

    
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
}

?>
