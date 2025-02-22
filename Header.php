<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="author" content="Jason">
    <title>header</title>
    <link rel="stylesheet" href="Style/style.css">
</head>
<header>
<?php
session_start();
?>

<nav class="navbar">
    <a class="navtext" href="home.php">Home</a>
    <a class="navtext" href="films.php">Alle films</a>
    <a class="navtext" href="abbonomenten.php">Abonnementen</a>

    <?php if (!isset($_SESSION['gebruikersnaam'])) { ?>
        <a class="navtext" href="inlog.php">Inloggen/ Registeren</a>
    <?php } else { ?>
        <a class="navtext" href="profiel.php">Profiel</a>
        <a class="navtext" href="addFilm.php">add Film toevoegen</a>
        <a class="navtext" href="logout.php">Logout</a>

        <?php
        $gebruikersnaam = htmlspecialchars($_SESSION['gebruikersnaam']);
        echo "<span class='navtext'>Welkom, $gebruikersnaam</span>";
        ?>
    <?php } ?>
</nav>
</header>


</html>