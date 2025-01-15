<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD_sakila_frz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>CRUD operations on Sakila</h1>
        <hr>
        <br>
        
        <h2 >Insert actor  <button onclick="location.href='insert_request.php';">NEW ACTOR</button> </h2>
        
        <?php
        require_once 'db_connection.php';
        $query = "SELECT * FROM actor;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Last Update</th><th>Actions</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['actor_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['last_update'] . "</td>";
                echo "<td>
                        <form action='update_request.php' method='GET'>
                            <input type='hidden' name='id' value='" . $row['actor_id'] . "'>
                            <button type='submit'>Update</button>
                        </form>
                        <form action='delete_request.php' method='GET'>
                            <input type='hidden' name='id' value='" . $row['actor_id'] . "'>
                            <button type='submit'>Delete</button>
                        </form>
                    </td>";
                
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No actors found.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
