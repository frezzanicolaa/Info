<?php

//example flow: controller-model:getAll -> controller-view:showAll

class ActorsController {

    //the conformity is checked before so i can assume that there'll be everytime a method where the program can go in
    public function show_all() {
        require_once 'Models/ActorsModel.php';
        require_once 'Views/ActorsView.php';
        ActorsView::show_all(ActorsModel::get_all());

    }

    public function show_one(){
        require_once 'Models/ActorsModel.php';
        require_once 'Views/ActorsView.php';
        header('Pages/selectOne.php');
        ActorsView::show_all(ActorsModel::get_one($_GET['id']));
    }

    
}
?>