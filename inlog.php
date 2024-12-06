<?php
session_start(); // Start de sessie
require_once 'Header.php'; // Include de header met navigatie
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>
<body>
    <h2>Login</h2>

    <form action="" method="post">
        <label for="gebruikers">Gebruikersnaam:</label>
        <input type="text" id="gebruikers" name="gebruikers" required>
        <br><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br><br>

        <input type="submit" name="login" value="Login">
    </form>

    <?php
    if (isset($_POST['login'])) {
        $gebruikers = htmlspecialchars($_POST['gebruikers']); // XSS protection
        $password = $_POST['password'];

        try {
            // Database connection using PDO
            $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare the SQL statement to prevent SQL injection
            $stmt = $conn->prepare('SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikers');
            $stmt->bindParam(':gebruikers', $gebruikers);
            $stmt->execute();

            // Check if a user is found
            if ($stmt->rowCount() > 0) {
                // Fetch the user's data
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Use password_verify() to check if the entered password matches the hash
                if (password_verify($password, $user['wachtwoord'])) {
                    // Zet de sessievariabele in en redirect naar Home.php
                    $_SESSION['gebruikersnaam'] = $gebruikers; // Bewaar gebruikersnaam in de sessie
                    header('Location: Home.php'); // Redirect naar Home.php
                    exit(); // Stop verdere uitvoering van de code
                } else {
                    echo "<p style='color: red;'>Onjuiste gebruikersnaam of wachtwoord.</p>";
                }
            } else {
                echo "<p style='color: red;'>Onjuiste gebruikersnaam of wachtwoord.</p>";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <!-- Link naar registeren.php -->
    <p>Heb je geen account? <a href="registeren.php">Klik hier om je te registreren</a></p>

    <?php
    require_once 'Footer.php'; // Footer
    ?>
</body>
</html>
