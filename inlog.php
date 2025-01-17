<?php
require_once 'Header.php'; 
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
        require "Classes/User.php";
        $user = new User();
        $user->inloggen($_POST);
    }
    ?>

 
    <p>Heb je geen account? <a href="registeren.php">Klik hier om je te registreren</a></p>

    <?php
    require_once 'Footer.php';
    ?>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const opgeslagenGebruikersnaam = localStorage.getItem('gebruikersnaam');
        if (opgeslagenGebruikersnaam) {
            document.getElementById('gebruikers').value = opgeslagenGebruikersnaam;
        }
    });

    document.getElementById('gebruikers').addEventListener('input', (event) => {
        const gebruikersnaam = event.target.value;
        localStorage.setItem('gebruikersnaam', gebruikersnaam);
    });

    document.querySelector('input[type="submit"]').addEventListener('click', () => {
        const gebruikersnaam = document.getElementById('gebruikers').value;
        if (gebruikersnaam) {
            localStorage.setItem('gebruikersnaam', gebruikersnaam);
        }
    });
</script>
