<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jason">
    <title>Registreren</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script" defer></script>
</head>

<body>
    <?php include "Header.php"; ?>

    <?php
    if(isset($_POST['submit'])){
        register($_POST);
      }
      
    ?>

    <main>
        <section class="sectionbox">
            <article>
                <img class="formimg" src="Images/certified.jpg" alt="certifiedD">
            </article>
            <article class="form-container">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="gebruikersnaam">Gebruikersnaam:</label><br>
                    <input class="input" type="text" id="gebruikersnaam" name="gebruikersnaam" required><br>
                    <label for="wachtwoord">Wachtwoord:</label><br>
                    <input class="input" type="password" id="wachtwoord" name="wachtwoord" required><br>
                    <label for="mail">@mail:</label><br>
                    <input class="input" type="email" id="mail" name="mail" required><br>
                    <label for="leeftijd">Leeftijd:</label><br>
                    <input class="input" type="text" id="leeftijd" name="leeftijd" required><br>
                    <label for="key_vraag">Verzin een vraag:</label><br>
                    <input class="input" type="text" id="key_vraag" name="key_vraag" required><br>
                    <label for="key_antwoord">Antwoord op je vraag:</label><br>
                    <input class="input" type="text" id="key_antwoord" name="key_antwoord" required><br>
                    <input type="submit" name="submit" value="Registreren">
                </form>
            </article>
        </section>
    </main>

    <?php include "Footer.php"; ?>
</body>

</html>
