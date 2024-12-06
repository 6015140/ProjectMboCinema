<?php
try {
    // Maak de verbinding met de database
    $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
    // Zet de PDO foutmodus naar uitzondering
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Echo de naam van de geselecteerde database
    echo "Verbonden met database: " . $conn->query('SELECT DATABASE()')->fetchColumn();
} catch(PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>
