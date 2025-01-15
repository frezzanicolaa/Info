<?php

class FilmsView{

    public static function show_all(mysqli_result $result): void {
        echo "<table>";
            echo "<tr><th>ID</th><th>Title</th><th>Description</th><th>Relase Year</th><th>Length</th><th>Last Update</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['film_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['release_year'] . "</td>";
                echo "<td>" . $row['length'] . "</td>";
                echo "<td>" . $row['last_update'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

    }


}

?>