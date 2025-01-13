<?php
abstract class Database{

    protected $conn;

    function __construct()
    {
        try {

            $this->conn = new PDO('mysql:host=localhost;dbname=phplesjaar2', 'root', '');
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
        } catch(PDOException $e) {
            echo "Verbinding mislukt: " . $e->getMessage();
        }
    } 
}
?>