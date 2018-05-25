<?php
/*On factorise la connexion à la BDD pour chaque requetes*/
try {
    $bdd = new PDO("mysql:host=localhost;dbname=tpforum;charset=utf8", "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); // Avec debogage pour le dernier argument
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>