<?php

class Route {
    private $url; //almacena la url de la ruta
    private $verb; //almacena el metodo http (get, post, etc..)
    private $controller; //maneja la ruta
    private $method; //metodo especifico del controlador
    private $params; //parametros de la url

    //inicia una nueva ruta con propiedades basicas
    public function __construct($url, $verb, $controller, $method){
        $this->url = $url; 
        $this->verb = $verb;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = []; //el parametro de inicia como una array vacio
    }

    public function match($url, $verb) {
        //verifica si la ruta coincide con la url y el http dado
        if($this->verb != $verb){
            return false;
        }
        //divide la url por partes usando '/' como separador
        $partsURL = explode("/", trim($url,'/'));
        $partsRoute = explode("/", trim($this->url,'/'));
        //verifico que tenga el mismo numero de parametros
        if(count($partsRoute) != count($partsURL)){
            return false;
        }
        //analizo cada parte de la ruta
        foreach ($partsRoute as $key => $part) {
            //
            if($part[0] != ":"){ //no es un parametro
                if($part != $partsURL[$key])
                    return false;
                } else { //es un parametro
                    $this->params[$part] = $partsURL[$key];
                }
            }
        return true;
    }
    public function run(){
        $controller = $this->controller;  //ejecuta controlador y metodos correspondintes
        $method = $this->method; //crea una nueva instancia del controlador y llama al metodo
        $params = $this->params; //pasa los parametros recolestados
       
        (new $controller())->$method($params);
    }
}

class Router {
    private $routeTable = []; //almacena todas las rutas
    /** @var Route|null */
    private $defaultRoute; //ruta por defecto

    public function __construct() {
        $this->defaultRoute = null;
    }

    public function route($url, $verb) {
        //busca una ruta que coincida con la url y verbo dados
        foreach ($this->routeTable as $route) {
            if($route->match($url, $verb)){
                //TODO: ejecutar el controller//ejecutar el controller
                // pasarle los parametros
                $route->run();
                return;
            }
        }
        //Si ninguna ruta coincide con el pedido y se configuró ruta por defecto.
        if ($this->defaultRoute != null){
            $this->defaultRoute->run();
        }
            
    }
    
    public function addRoute ($url, $verb, $controller, $method) {
        //agrega una nueva ruta a la tabla de rutas
        $this->routeTable[] = new Route($url, $verb, $controller, $method);
    }

    public function setDefaultRoute($controller, $method) {
        //establece una ruta por defecto
        $this->defaultRoute = new Route("", "", $controller, $method);
    }
}
