<?php



class Router {
    private $defaultController = "pages";
    private $defaultAction = "go_home";

    public function route() {
        // parameters extraction
        $controller = isset($_GET['controller']) ? $_GET['controller'] : $this->defaultController;
        $action = isset($_GET['action']) ? $_GET['action'] : $this->defaultAction;

        // building the controller's class name
        $controllerClass = ucfirst($controller) . "Controller";
        $controllerFile = "Controllers/$controllerClass.php";

        // checking file and class 
        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            if (class_exists($controllerClass)) {
                $controllerInstance = new $controllerClass();

                if (method_exists($controllerInstance, $action)) {
                    // calling action's method
                    $controllerInstance->$action();
                } else {
                    echo "Metodo $action non trovato nel controller $controllerClass.";
                }
            } else {
                echo "Classe controller $controllerClass non esistente.";
            }
        } else {
            echo "File controller $controllerFile non trovato.";
        }
    }
}

?>
