<?php

class ActorsView{

    public static function show_all(array $actors): void {
        echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Surname</th><th>Last Update</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['actor_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['last_update'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";

    }

}

?>