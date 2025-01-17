<?php
require 'classes/film.php';
$film = new Film();
if(isset($_POST['change'])){
    $film->bewerkfilms($_GET['id']);
    
    header("Location: films.php");
}

$currFilm = $film->getFilmById($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit een film</title>
</head>
<?php
include "Header.php";
?>
<body>
    <h1>edit film informatie</h1>
    <form action="" method="post">
        <input type="text" name="titel" value="<?php echo $currFilm['titel'];?>"placeholder="Title" required>
        <textarea name="omschrijving" placeholder="Description" required><?php echo $currFilm['omschrijving'];?></textarea>
        <input type="text" name="release_datum" value="<?php echo $currFilm['release_datum'];?> "placeholder="Release Date" required>
        <input type="text" name="genre" value="<?php echo $currFilm['genre'];?>"placeholder="Genre" required>
        <input type="number" name="duur" value="<?php echo $currFilm['duur'];?>" placeholder="Duration (minuten)" required>
        <input type="url" name="poster_url" value="<?php echo $currFilm['poster_url'];?>" placeholder="Poster URL" required>
        <button name="change" type="submit">editFilm</button>
    </form>

</body>
<?php
include "Footer.php";
?>
</html>
