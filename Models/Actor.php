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
        $this->lastUpdate = DateTime::createFromFormat('Y-m-d H:i:s', $lastUpdate);
    }
    
    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getLastUpdate(): string {
        return $this->lastUpdate->format('Y-m-d H:i:s');
    }

    public static function get_all(): array {
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM actor;";
    
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $arrayActors = [];
        
        while ($row = $result->fetch_assoc()) {
            $actor = new Actor(
                $row['actor_id'],
                $row['first_name'],
                $row['last_name'],
                $row['last_update'],
            );
            $arrayActors[] = $actor;
        }
    
        $conn->close();
        return $arrayActors;
    }

    public static function get_one(int $actorId): Actor {
        require_once 'DB/db_connection.php';
        $query = "SELECT * FROM actor WHERE actor_id = ?";
    
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $actorId);  
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows <= 0) {
            die('No item found');
        }
    
        $row = $result->fetch_assoc();
        $conn->close();
        
        return new Actor(
            $row['actor_id'],
            $row['first_name'],
            $row['last_name'],
            $row['last_update'],
        );
    }
    
   
}

?>