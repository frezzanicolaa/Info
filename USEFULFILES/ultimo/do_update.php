<?php
require_once 'db_connection.php';

// controllo che ci siano tutti i dati
if (isset($_POST['id']) && isset($_POST['first_name']) && isset($_POST['last_name'])) {
    
    //var per binding
    $id = intval($_POST['id']);             
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    //query per aggiornare i dati dell'attore
    $query = "UPDATE actor SET first_name = ?, last_name = ?, last_update = NOW() WHERE actor_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $first_name, $last_name, $id);

    if ($stmt->execute()) {
        header("Location: index.php"); //se è tuttok torna a index (che a sua volta tornerà a showall)
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    die("Invalid input.");
}
?>
