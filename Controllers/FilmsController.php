<?php

class FilmsController {

    public function show_all() {
        require_once 'Models/FilmsModel.php'; 
        require_once 'Views/FilmsView.php';
        FilmsView::show_all(FilmsModel::get_all());
    }
}
?>