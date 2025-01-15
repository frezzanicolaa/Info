<?php

class FilmsController {

    //the conformity is checked before so i can assume that there'll be everytime a method where the program can go in
    public function show_all() {
        require_once 'Models/FilmsModel.php'; 
        require_once 'Views/FilmsView.php';
        FilmsView::show_all(FilmsModel::get_all());
    }
}
?>