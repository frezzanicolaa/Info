<?php
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    //per confermare ho bisogno prima di selezionare comuneuq l'attore
    $query = "SELECT * FROM actor WHERE actor_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $actor = $result->fetch_assoc();
   
    
    //se si conferma 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //prima tocca rimuovere anche tutte le relazioni in film_actor
        $deleteFilmActorQuery = "DELETE FROM film_actor WHERE actor_id = ?";
        $deleteFilmActorStmt = $conn->prepare($deleteFilmActorQuery);
        $deleteFilmActorStmt->bind_param('i', $id);
        $deleteFilmActorStmt->execute();

        //ora elimino l'attore
        $deleteActorQuery = "DELETE FROM actor WHERE actor_id = ?";
        $deleteActorStmt = $conn->prepare($deleteActorQuery);
        $deleteActorStmt->bind_param('i', $id);

        if ($deleteActorStmt->execute()) {
            //funziona tutto
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting actor: " . $conn->error;
        }
    }
} else {
    die("No ID provided.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Actor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Are you sure?</h1>
        <p>Name: <?php echo $actor['first_name'] . ' ' . $actor['last_name']; ?></p>
        <p>Last Update: <?php echo $actor['last_update']; ?></p>
    
        <!-- form per confermare l'eliminazione -->
        <form method="POST">
            <button type="submit">Yeah</button>
        </form>
    
        <!-- form per annullare l'eliminazione (non fare nulla e tornare a index, quindi a show_all) -->
        <form action="index.php" method="GET">
            <button type="submit">Nope</button>
        </form>
    </div>
</body>
</html>
