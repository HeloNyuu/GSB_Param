<?php

function connexionPDO() {
    $login = 'gsb';
    $mdp = '';
    $bd = 'gsb_param';
    $serveur = 'localhost';

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd",$login,$mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}

?>
