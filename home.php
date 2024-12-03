<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioscoop</title>
    <link rel="stylesheet" href="style/cinemastyle.css">
</head>
<body>
    <div class="content">
        <h1>Welkom bij Bioscoop Deluxe</h1>
        <p>Kies je film en geniet van de show!</p>

        <!-- Zoekbalk -->
        <form method="GET" class="search-form">
            <input type="text" name="search" placeholder="Zoek een film..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit">Zoeken</button>
        </form>

        <div class="movie-list">
            <?php
            // Array van films
            $films = [
                [
                    "titel" => "Avontuur in de Ruimte",
                    "beschrijving" => "Een spannende reis door de ruimte met Captain Star.",
                    "afbeelding" => "ruimte.jpg"
                ],
                [
                    "titel" => "De Jungle Koning",
                    "beschrijving" => "Het epische verhaal van een leeuw die zijn plek in de jungle terugwint.",
                    "afbeelding" => "jungle.jpg"
                ],
                [
                    "titel" => "Mysterie op de Trein",
                    "beschrijving" => "Een meeslepende thriller vol onverwachte wendingen.",
                    "afbeelding" => "trein.jpg"
                ]
            ];

            // Zoekfunctionaliteit
            $zoekterm = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
            $gefilterde_films = array_filter($films, function ($film) use ($zoekterm) {
                return $zoekterm === '' || strpos(strtolower($film['titel']), $zoekterm) !== false;
            });

            // Dynamisch gefilterde films weergeven
            if (empty($gefilterde_films)) {
                echo "<p>Geen films gevonden met de term '<strong>" . htmlspecialchars($zoekterm) . "</strong>'.</p>";
            } else {
                foreach ($gefilterde_films as $film) {
                    echo "
                    <div class='movie'>
                        <img src='{$film['afbeelding']}' alt='{$film['titel']}'>
                        <h2>{$film['titel']}</h2>
                        <p>{$film['beschrijving']}</p>
                        <button>Koop Tickets</button>
                    </div>
                    ";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
