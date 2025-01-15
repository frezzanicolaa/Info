<?php

//flow: index-router -> router-model -> model-router -> router-view 



class Router {
    public function route() {
        
        //building the controler string
        $controller = ucfirst(strtolower($_GET['controller'] ?? 'pages')) . 'Controller';
        //getting the action string
        $action = $_GET['action'] ?? 'go_home';

        $controllerFile = "Controllers/$controller.php";

        //check file
        if (!file_exists($controllerFile)) {
            die("Controller not found: $controller");
        }
        //if file exist require it
        require_once $controllerFile;

        //check class
        if (!class_exists($controller)) {
            die("class not found: $controller");
        }
        //if the required class exist, go on and instance the controller 
        $controllerInstance = new $controller();

        //check action
        if (!method_exists($controllerInstance, $action)) {
            die("Non valid method: $action");
        }
        //run the method if exists!!
        $controllerInstance->$action();
    }
}

?>
