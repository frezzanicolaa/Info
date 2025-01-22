<?php

class ActorsView {
    public static function show_all(array $actors): void {
        echo "<h1>Lista degli Attori</h1>";
        if (count($actors) > 0) {
            echo "<ul>";
            foreach ($actors as $actor) {
                echo "<li>
                    <a href='index.php?controller=actors&action=show_one&id={$actor->getId()}'>
                        {$actor->getFirstName()} {$actor->getLastName()}
                    </a>    
                </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nessun attore trovato.</p>";
        }
    }

    public static function show_one($actor) {
        if ($actor) {
            echo "<h1>Dettagli Attore</h1>";
            echo "<p>ID: {$actor->getId()}</p>";
            echo "<p>Nome: {$actor->getFirstName()}</p>";
            echo "<p>Cognome: {$actor->getLastName()}</p>";
        } else {
            echo "<h1>Attore non trovato</h1>";
        }
    }
}


?>