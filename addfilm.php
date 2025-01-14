<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg een Film toe</title>
</head>
<?php
include "Header.php";
?>
<body>
    <h1>Voeg een nieuwe Film toe</h1>
    <form action="addfilm.php" method="post">
        <input type="text" name="titel" placeholder="Title" required>
        <textarea name="omschrijving" placeholder="Description" required></textarea>
        <input type="text" name="release_datum" placeholder="Release Date" required>
        <input type="text" name="genre" placeholder="Genre" required>
        <input type="number" name="duur" placeholder="Duration (minuten)" required>
        <input type="url" name="poster_url" placeholder="Poster URL" required>
        <button name="submit" ="submit">Add Film</button>
    </form>
    
    <?php
if(isset($_POST['submit'])){
require 'classes/film.php';

$filmClass = new Film();
$filmClass->addFilm();
$_POST = array();
}
?>

</body>
<?php
include "Footer.php";
?>
</html>
