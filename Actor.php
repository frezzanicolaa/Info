<?php
class Actor {
    private int $id;
    private string $firstName;
    private string $lastName;
    private DateTime $lastUpdate;

    public function __construct($id,$firstName,$lastName,$lastUpdate){
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->lastUpdate = $lastUpdate;
    }
    
    public static function getActor(int $id): Actor{
        
        $con = ConnectDb::getConnection();
        
        $query = "SELECT * FROM actor WHERE actor_id =".$id.";";
        
        $result = $con-> query($query); //eseguo la query
        
        $con->close();
        $result ->fetch_obj();

        return new Actor($result);
    }

    public static function getAll(): array{
        $arrayActor = [];

        $con = ConnectDb::getConnection();
        
        $query = "SELECT * FROM actor";
        
        $result = $con-> query($query); //eseguo la query
        
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
   
}

?>