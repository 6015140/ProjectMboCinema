<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonnementen</title>
    <meta name="description" content="Ontdek onze luxe bioscoopabonnementen voor volwassenen. Geniet van exclusieve voordelen en beleef de ultieme filmervaring.">
    <meta name="keywords" content="bioscoop, abonnementen, luxe, filmervaring, volwassenen">
    <meta name="author" content="MboCinema">
</head>
<?php
require "header.php"
?>
<body>
<div class="abonnementen">
    <div class="abonnement">
        <img src="img/bioscoop.jpg" alt="Afbeelding Abonnement">
        <h2>Volwassen abonnement</h2>
        <p>Beleef al onze luxe.</p>
        <button>Koop nu</button>
    </div>
    <div class="abonnement">
        <img src="img/bioscoop.jpg" alt="Afbeelding Abonnement">
        <h2>Volwassen abonnement</h2>
        <p>Beleef al onze luxe.</p>
        <button>Koop nu</button>
    </div>
</div>

<style>
    .abonnementen {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin: 20px auto;
        padding: 20px;
    }

    .abonnement {
        border: 1px solid #ddd;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        padding: 15px;
        text-align: center;
        background-color: #fff;
    }

    .abonnement img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 5px;
    }

    .abonnement h2 {
        font-size: 1.4em;
        color: #333;
        margin: 10px 0;
    }

    .abonnement p {
        color: #666;
        font-size: 1em;
        margin-bottom: 15px;
    }

    .abonnement button {
        background-color: #c70039;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 1em;
        border-radius: 5px;
        cursor: pointer;
    }

    .abonnement button:hover {
        background-color: #900027;
    }

    @media (min-width: 600px) {
        .abonnementen {
            flex-direction: column;
            flex-wrap: wrap;
            justify-content: center;
        }

        .abonnement {
            width: 45%;
            max-width: 350px;
        }
    }

    @media (min-width: 1024px) {
        .abonnement {
            width: 30%;
        }
    }
</style>
</body>
<?php
require "Footer.php"
?>
</html>