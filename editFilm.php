<?php
require 'classes/film.php';
$film = new Film();
if(isset($_POST['submit'])){
    //$film->editFilm($_GET['id']);
    header("Location: films.php");
}
$film = $film->getFilmById($_GET['id']);


?>
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
        <input type="text" name="titel" value="<?php echo $film['titel'];?>"placeholder="Title" required>
        <textarea name="omschrijving" placeholder="Description" required><?php echo $film['omschrijving'];?></textarea>
        <input type="text" name="release_datum" value="<?php echo $film['release_datum'];?> "placeholder="Release Date" required>
        <input type="text" name="genre" value="<?php echo $film['genre'];?>"placeholder="Genre" required>
        <input type="number" name="duur" value="<?php echo $film['duur'];?>" placeholder="Duration (minuten)" required>
        <input type="url" name="poster_url" value="<?php echo $film['poster_url'];?>" placeholder="Poster URL" required>
        <button name="submit" ="submit">editFilm</button>
    </form>

</body>
<?php
include "Footer.php";
?>
</html>
