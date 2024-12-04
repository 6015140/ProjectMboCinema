<?php
require "header.php"
?>

<?php
session_start();





// Definieer welke formulier momenteel zichtbaar moet zijn (login of register)
$formType = isset($_GET['form']) ? $_GET['form'] : 'login'; // Standaard is 'login'

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Inlogproces
    if (isset($_POST['login'])) {
        $username = htmlspecialchars($_POST['username']); // XSS bescherming
        $password = $_POST['password'];

        try {
            // Databaseverbinding met PDO
            $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL query voorbereiden om SQL-injecties te voorkomen
            $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Controleren of een gebruiker wordt gevonden
            if ($stmt->rowCount() > 0) {
                // Gebruikersgegevens ophalen
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Gebruik password_verify() om te controleren of het ingevoerde wachtwoord overeenkomt met de hash
                if (password_verify($password, $user['password'])) {
                    $_SESSION['gebruikersnaam'] = $username;
                    header("Location: abonnementen.php"); // Doorsturen naar abonnementenpagina na inloggen
                    exit();
                } else {
                    $errorMessage = "Onjuiste gebruikersnaam of wachtwoord.";
                }
            } else {
                $errorMessage = "Onjuiste gebruikersnaam of wachtwoord.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Fout: " . $e->getMessage();
        }
    }

    // Registratieproces
    if (isset($_POST['register'])) {
        $new_username = htmlspecialchars($_POST['new_username']);
        $new_password = $_POST['new_password'];
        $password_confirm = $_POST['password_confirm'];

        if ($new_password === $password_confirm) {
            try {
                // Databaseverbinding met PDO
                $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Controleren of de gebruikersnaam al bestaat
                $stmt = $conn->prepare('SELECT * FROM users WHERE username = :username');
                $stmt->bindParam(':username', $new_username);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    // Wachtwoord hashen en opslaan
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
                    $stmt->bindParam(':username', $new_username);
                    $stmt->bindParam(':password', $hashed_password);
                    $stmt->execute();

                    $successMessage = "Registratie succesvol! Je kunt nu inloggen.";
                    // Stuur de gebruiker naar de loginsectie na registratie
                    $formType = 'login';
                } else {
                    $errorMessage = "Gebruikersnaam bestaat al.";
                }
            } catch (PDOException $e) {
                $errorMessage = "Fout: " . $e->getMessage();
            }
        } else {
            $errorMessage = "Wachtwoorden komen niet overeen.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Inloggen of Registreren</title>
</head>
<body>

<h2><?php echo ($formType == 'login') ? 'Inloggen' : 'Registreren'; ?></h2>

<!-- Formulier weergeven afhankelijk van de actie -->
<?php if ($formType == 'login') : ?>
    <form action="inlog_register.php?form=login" method="post">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" name="login" value="Inloggen">
    </form>
    <p>Heb je nog geen account? <a href="inlog_register.php?form=register">Registreren</a></p>
<?php elseif ($formType == 'register') : ?>
    <form action="inlog_register.php?form=register" method="post">
        <label for="new_username">Gebruikersnaam:</label>
        <input type="text" id="new_username" name="new_username" required>
        <br><br>

        <label for="new_password">Wachtwoord:</label>
        <input type="password" id="new_password" name="new_password" required>
        <br><br>

        <label for="password_confirm">Bevestig wachtwoord:</label>
        <input type="password" id="password_confirm" name="password_confirm" required>
        <br><br>

        <input type="submit" name="register" value="Registreren">
    </form>
    <p>Heb je al een account? <a href="inlog_register.php?form=login">Inloggen</a></p>
<?php endif; ?>

<!-- Fouten of succesberichten -->
<?php
if (isset($errorMessage)) {
    echo "<p style='color: red;'>$errorMessage</p>";
}
if (isset($successMessage)) {
    echo "<p style='color: green;'>$successMessage</p>";
}
?>

</body>
<?php
require "Footer.php"
?>
</html>
