<?php

namespace Core\Router;

class Router {

    private $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url){
        $this->url = $url;
    }

    /**
     *
     * Add a get method URI
     *
     * @param string $path
     * @param callable $callable
     * @param null $name
     */
    public function get($path, $callable, $name = null){
        $this->add($path, $callable, $name, 'GET');
    }

    /**
     *
     * add post method URI
     *
     * @param string $path
     * @param callable$callable
     * @param null $name
     */
    public function post($path, $callable, $name = null){
        $this->add($path, $callable, $name, 'POST');
    }

    /**
     *
     * Add URI to the routes property array with the specified method
     *
     * @param string $path
     * @param callable $callable
     * @param string $name
     * @param string  $method
     */
    private function add($path, $callable, $name, $method){
        $route = new Route($path,$callable);
        $this->routes[$method][] = $route;
        if($name){
            $this->namedRoutes[$name] = $route;
        }
    }

    /**
     *
     * Check if the request URI is define in the registered URI
     * if true, call the function from the url
     * else, return false and generate a 404 error
     *
     * @return false|callable
     */
    public function run(){

        $requestMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        if(!isset($this->routes[$requestMethod])){
            return false;
        } 

        foreach($this->routes[$requestMethod] as $route){

            if($route->match($this->url)){
                return $route->call();
            }

        }
        return false;

    }

}