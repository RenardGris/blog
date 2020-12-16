<?php

namespace Core\Router;

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function get($path, $callable, $name = null){
        $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null){
        $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method){
        $route = new Route($path,$callable);
        $this->routes[$method][] = $route;
        if($name){
            $this->namedRoutes[$name] = $route;
        }
    }

    public function run(){

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if(!isset($this->routes[$requestMethod])){
            throw new RouterException('Request Method not exist');
        } 

        foreach($this->routes[$requestMethod] as $route){

            if($route->match($this->url)){
                return $route->call();
            }

        }
        throw new RouterException('No matching routes');
    }

}