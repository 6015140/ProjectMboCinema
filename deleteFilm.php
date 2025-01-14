<?php
require 'classes/film.php';
$film = new Film();
$film->deleteFilm($_GET['id']);
header("Location: films.php");
?>