<?php
class Film {
    private int $id;
    private string $title;
    private ?string $desc;
    private ?int $relaseYear;
    private ?int $langId;
    private ?int $originalLangId;
    private ?int $rentalDuration;
    private ?float $rentalRate;
    private ?int $length;  
    private ?float $repCost;
    private ?string $rating;
    private ?string $spFeature;
    private ?DateTime $lastUpdate;


    public function __construct(int $id,string $title,?string $desc,?int $relaseYear,?int $langId,?int $originalLangId,?int $rentalDuration,?float $rentalRate,?int $length,?float $repCost,
    ?string $rating,?string $spFeature,?DateTime $lastUpdate){
        $this->id = $id;
        $this->title = $title;
        $this->desc = $desc;
        $this->relaseYear = $relaseYear;
        $this->langId = $langId;
        $this->originalLangId = $originalLangId;
        $this->rentalDuration = $rentalDuration;
        $this->rentalRate = $rentalRate;
        $this->length = $length;
        $this->repCost = $repCost;
        $this->rating = $rating;
        $this->spFeature = $spFeature;
        $this->lastUpdate = $lastUpdate;
    }

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

    public function toString(): string{
        $dateString = date_format($this->lastUpdate, 'd/m/Y H:i:s');
        
        return $this->id.'<br>'.
        $this->title.'<br>'.
        $this->desc.'<br>'.
        $this->relaseYear.'<br>'.
        $this->langId.'<br>'.
        $this->originalLangId.'<br>'.
        $this->rentalDuration.'<br>'.
        $this->rentalRate.'<br>'.
        $this->length.'<br>'.
        $this->repCost.'<br>'.
        $this->rating.'<br>'.
        $this->spFeature.'<br>'.
        $dateString;
        
        
    }

    public function show(): void {
        echo $this->toString();
    }

    
}
?>