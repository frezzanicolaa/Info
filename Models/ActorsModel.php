<?php

class ActorsModel{

    public static function get_all(): array {
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM actor;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        while($arrayActor = $result->fetch_obj()){
            $actor = new Actor(
                $arrayActor['actor_id'],
                $arrayActor['first_name'],
                $arrayActor['last_name'],
                new DateTime($arrayActor['last_update']),
            );
            $array[] = $actor;
        }

        
        $con->close();

        return $arrayActor;
    }

    public static function get_one(int $actorId): Actor {
        
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
        $result->fetch_obj();
        return new Actor($result);
    }
}

?>