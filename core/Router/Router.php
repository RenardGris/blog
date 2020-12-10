<?php

namespace Core\Router;

use App\Controller;

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];
    private $_url;

    public function __construct($url){
        $this->url = $url;
    }

    // public function get($path, $callable, $name){
    //     $route = new Route($path,$callable);
    //     $this->routes['GET'][] = $route;
    // }

    // public function post($path, $callable, $name){
    //     $route = new Route($path,$callable);
    //     $this->routes['POST'][] = $route;
    // }

    public function get($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null){
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method){
        $route = new Route($path,$callable);
        $this->routes[$method][] = $route;
        if($name){
            $this->namedRoutes[$name] = $route;
        }
    }

    public function run(){
        // echo '<pre>';
        // print_r($this->routes);
        // echo '</pre>';

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