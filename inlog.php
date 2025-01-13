<?php
require_once 'Header.php'; 
require_once 'Database.php';
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
        $gebruikers = htmlspecialchars($_POST['gebruikers']); 
        $password = $_POST['password'];

        try {            
            $stmt = $conn->prepare('SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikers');
            $stmt->bindParam(':gebruikers', $gebruikers);
            $stmt->execute();

           
            if ($stmt->rowCount() > 0) {
                
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                
                if (password_verify($password, $user['wachtwoord'])) {
                   
                    $_SESSION['gebruikersnaam'] = $gebruikers; 
                    header('Location: Home.php'); 
                    exit(); 
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

 
    <p>Heb je geen account? <a href="registeren.php">Klik hier om je te registreren</a></p>

    <?php
    require_once 'Footer.php';
    ?>
</body>
</html>
