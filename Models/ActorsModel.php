<?php

class ActorsModel{

    public static function get_all(): mysqli_result {
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM actor;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows <= 0){
            die('no items to be showed');
        }

        $conn->close();
        return $result;
    }

    public static function get_one(int $actorId): mysqli_result {
        
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM actor
                  WHERE actor_id =". $actorId .";";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows <= 0){
            die('no item found');
        }

        $conn->close();
        return $result;
    }
}

?>