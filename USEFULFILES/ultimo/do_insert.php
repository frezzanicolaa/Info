<?php

require_once 'db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    //prepared statement
    $query = "INSERT INTO actor (first_name, last_name) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $firstName, $lastName); //ometto sia id che lastUpdate perche tanto il database impone delle funzioni per generarli

    //esegue query
    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Errore nell'inserimento: " . $conn->error;
    }
}

$conn->close();
?>
