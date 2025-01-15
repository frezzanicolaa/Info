<?php

require_once 'db_config.php';

// creating connection with the config infos
$conn = new mysqli($host, $username, $password, $dbname);

// directly checking here the conn status so i don't have to do it then in the others files
if ($conn->connect_error) {
    die("Errore di connessione al db: " . $conn->connect_error);
}
?>
