<?php
include 'header.php';
?>

<?php
if(!isset($_SESSION['gebruikersnaam'])){
    header('Location: inlog.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<form action="addFilm.php" method="post">
    <input type="text" name="title" placeholder="title">
    <input type="text" name="omschrijving" placeholder="omschrijving">
    <input type="date" name="release_datum" placeholder="release_datum">
    <input type="text" name="genre" placeholder="genre">
    <input type="number" name="duur" placeholder="duur">
    <input type="file" name="upload">
    <button type="submit" name="submit">submit</button>

</body>
<?php
include 'footer.php';
    ?>
</html>