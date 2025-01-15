<?php

class FilmsModel{

    public static function get_all(): mysqli_result {
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM film;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows <= 0){
            die('no items to be showed');
        }

        $conn->close();
        return $result;

    }

}

?>