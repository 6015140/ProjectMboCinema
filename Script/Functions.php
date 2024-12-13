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
        // Zorg ervoor dat je de databaseverbinding via PDO maakt
        require "Database.php";  // Zorg ervoor dat $conn een PDO-object is

        // Voorbereiden en uitvoeren van de query
        $stmt = $conn->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam");
        $stmt->bindParam(':gebruikersnaam', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);  // Haal het resultaat op

        if ($result) {
            if (password_verify($password, $result['wachtwoord'])) {
                session_start();  // Start de sessie voordat je de gebruikersgegevens opslaat
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

        // Geen expliciete sluiting van de verbinding nodig bij PDO
        //$stmt->close();  // Niet nodig in PDO
    }

    return $error;  // Return de foutmelding (als die er is)
}
?>

// regi

<?php

function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require "Database.php";  // Zorg ervoor dat $conn een PDO-object is

        // Verkrijg de gegevens uit het formulier
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

            // SQL-query voor het registreren van een gebruiker
            $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord, mail, leeftijd, key_vraag, key_antwoord) 
                    VALUES (:gebruikersnaam, :wachtwoord, :mail, :leeftijd, :key_vraag, :key_antwoord)";

            $stmt = $conn->prepare($sql);

            // Bind de parameters voor de query
            $stmt->bindParam(':gebruikersnaam', $username, PDO::PARAM_STR);
            $stmt->bindParam(':wachtwoord', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':leeftijd', $leeftijd, PDO::PARAM_INT);
            $stmt->bindParam(':key_vraag', $key_vraag, PDO::PARAM_STR);
            $stmt->bindParam(':key_antwoord', $hashed_key_antwoord, PDO::PARAM_STR);

            // Voer de query uit
            if ($stmt->execute()) {
                echo "Gebruiker succesvol geregistreerd.";
            } else {
                echo "Er is een fout opgetreden bij het registreren van de gebruiker: " . htmlspecialchars($stmt->errorInfo()[2]);
            }

            // Geen expliciete sluiting van de verbinding nodig bij PDO
            //$stmt->close();  // Niet nodig in PDO
        }
    }
}

?>
