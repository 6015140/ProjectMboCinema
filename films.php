<?php

require 'classes/film.php';
require 'header.php';

$filmClass = new Film();

$films = $filmClass->getAllFilms();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
</head>
<body>
    <h1>Filmoverzicht</h1>
    <ul>
        <?php foreach ($films as $film): ?>
            <li>
                <h2><?php echo htmlspecialchars($film['titel']); ?></h2>
                <p><?php echo htmlspecialchars($film['omschrijving']); ?></p>
                <p>Genre: <?php echo htmlspecialchars($film['genre']); ?></p>
                <p>Duur: <?php echo htmlspecialchars($film['duur']); ?> minuten</p>
                <p>releasejaar: <?php echo htmlspecialchars($film['release_datum']); ?></p>
                <img src="<?php echo htmlspecialchars($film['poster_url']); ?>" alt="<?php echo htmlspecialchars($film['titel']); ?>">
                <a href="editFilm.php?id=<?php echo $film['film_id'] ?>">Bewerk</a><a href="deleteFilm.php?id=<?php echo $film['film_id'] ?>">Verwijder</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php
require "Footer.php"
?>
</body>
</html>
