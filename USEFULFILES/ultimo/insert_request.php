<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Insert New Actor</h1>
    
        <form action="do_insert.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br>
    
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br>
    
            <button type="submit">Insert Actor</button>
        </form>
    
        <br><a href="index.php">Back to Actors List</a>
    </div>
</body>
</html>
