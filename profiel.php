<?php
include 'header.php';

// Voorbeeld van gebruikersinformatie, dit zou normaal uit een database komen
$_SESSION['gebruikers'] = 'Gebruiker123';
$_SESSION['account_balance'] = 100.50;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiel Pagina</title>
</head>
<body>
    <h1>Welkom op je profielpagina</h1>
    <p>Hier kun je je profielinformatie bekijken en bewerken.</p>
    <p>Gebruikersnaam: <?php echo $_SESSION['gebruikers']; ?></p>
    <p>Balans: €<?php echo number_format($_SESSION['account_balance'], 2); ?></p>
</body>
</html>
