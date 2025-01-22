<?php

//example flow: controller-model:getAll -> controller-view:showAll

require_once 'Models/Actor.php';
require_once 'Views/ActorsView.php';

class ActorsController {

    
    public function show_all() {
        
        //getting actors from model
        $actors = Actor::get_all();

        //displaying them
        ActorsView::show_all($actors);
    }

    public function show_one(){
        
        $id = isset($_GET['id']) ? (int)$_GET['id'] : null;

        if ($id) {
            $actor = Actor::get_one($id);
            
            ActorsView::show_one($actor);
        } else {
            echo "<h1>ID non fornito</h1>";
        }
    }

    
}
?>