<?php 
namespace App\core;
class Router 
{
    public function routes()
    {
        $controller = (isset($_GET["controller"]) ? ucfirst($_GET["controller"]) : "Home");
        $controller = "\\App\\controllers\\".$controller."Controller";
        $action = (isset($_GET["action"]) ? $_GET["action"] : "index");
        unset($_GET["controller"]);
        unset($_GET["action"]);
        if(class_exists($controller)){
            $controller = new $controller();
            if(method_exists($controller,$action)){
                (!empty($_GET)) ? $controller->$action($_GET) : $controller->$action();
            }else{
                http_response_code(404);
                echo "La méthode recherchée n'existe pas";
            }
        }else{
            http_response_code(404);
            echo "La page recherchée n'existe pas";
        }
    }
}
?>