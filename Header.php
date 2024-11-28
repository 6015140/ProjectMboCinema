<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jason">
    <title>header</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<header>
    <?php
    session_start();
    require_once('Script/Functions.php');
    ?>
    <nav class="navbar">
        <a class="navtext" href="index.php">Home</a>
        <a class="navtext" href="games.php">Games</a>
        <?php if (!isset($_SESSION['gebruikersnaam'])) { ?>
            <a class="navtext" href="inlog.php">Inloggen/ Registeren</a>
        <?php } else {  ?>
            <a class="navtext" href="profiel.php">Profiel</a>
            <a class="navtext" href="vriendenpagina.php">Vrienden</a>
            <a class="navtext" href="logout.php">Logout</a>
        <?php
            echo $_SESSION['gebruikersnaam'];
        } ?>
    </nav>
</header>

</html>