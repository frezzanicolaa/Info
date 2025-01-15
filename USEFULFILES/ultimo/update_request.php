<?php
require_once 'db_connection.php';


if (isset($_GET['id'])) {// controllo se ho il parametro
    $id = intval($_GET['id']); //prendo il valore intero utile sia per il bind param che per evitare sql injection

    //prepared statemeent
    $query = "SELECT * FROM actor WHERE actor_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $actor = $result->fetch_assoc();//i valori dell'array saranno poi visualizzati nel form html
} 
else {
    die("No ID provided.");
}
?>


<html>
<head>
    <title>Update Actor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Actor</h1>
        <form action="do_update.php" method="POST"> 
            <input type="hidden" name="id" value="<?php echo $actor['actor_id']; ?>">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo $actor['first_name']; ?>" required><br>
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="<?php echo $actor['last_name']; ?>" required><br>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
