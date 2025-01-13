<?php
require_once 'FilmRepository.php';

// Maak verbinding met de database
$filmRepository = new FilmRepository('localhost', 'phplesjaar2', 'root', '');

// Haal alle films op
$films = $filmRepository->getAllFilms();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBOcinema - Films</title>
    <link rel="stylesheet" href="Style/style.css">
    <meta name="description" content="Bekijk de nieuwste films in de bioscoop bij MBOcinema. Van avonturenfilms tot thrillers, er is voor ieder wat wils.">
    <meta name="keywords" content="films, bioscoop, MBOcinema, avontuur, thriller, drama, actie, familie, horror">
    <meta name="author" content="MBOcinema">
</head>
<?php require "header.php"; ?>
<body>
    <div class="container">
        <h1>Films in de bioscoop</h1>
        <div class="movies-grid">
            <?php foreach ($films as $film): ?>
                <div class="movie">
                    <img src="<?= $film->posterUrl ?>" alt="<?= htmlspecialchars($film->titel) ?>" class="movie-poster">
                    <h2><?= htmlspecialchars($film->titel) ?></h2>
                    <p><?= htmlspecialchars($film->omschrijving) ?></p>
                    <p><strong>Genre:</strong> <?= htmlspecialchars($film->genre) ?></p>
                    <p><strong>Release:</strong> <?= htmlspecialchars($film->releaseDatum) ?></p>
                    <p><strong>Duur:</strong> <?= htmlspecialchars($film->duur) ?> minuten</p>
                    <a href="#" class="button">Tickets kopen</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
<?php require "Footer.php"; ?>
</html>