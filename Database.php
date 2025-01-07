<?php
try {
  
    $conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    echo "Verbonden met database: " . $conn->query('SELECT DATABASE()')->fetchColumn();
} catch(PDOException $e) {
    echo "Verbinding mislukt: " . $e->getMessage();
}
?>
