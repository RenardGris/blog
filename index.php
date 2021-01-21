<?php

//define('ROOT', dirname(__DIR__));
$path = filter_input(INPUT_SERVER, 'SCRIPT_FILENAME');
$path = explode('index.php', $path);
define('ROOT', $path[0]);

require 'vendor/autoload.php';

use Core\Router;
use App\Controller;
use App\App;

App::load();

$router = new Router\Router(filter_input(INPUT_GET, 'url'));

$router->get('/', function () {
    $controller = new Controller\AppController();
    $controller->home();
});
$router->post('/', function () {
    $controller = new Controller\AppController();
    $controller->home();
});
$router->get('/posts', function () {
    $controller = new Controller\PostsController;
    $controller->index();
});
$router->post('/posts/:id', function ($id) {
    $controller = new Controller\Admin\CommentsController;
    $controller->addComments($id);
});

$router->get('/posts/:id', function ($id) {
    $controller = new Controller\PostsController;
    $controller->show($id);
});

//Login
$router->get('/login', function () {
    $controller = new Controller\UsersController;
    $controller->login();
});

$router->post('/login', function () {
    $controller = new Controller\UsersController;
    $controller->login();
});

$router->post('/logout', function () {
    $controller = new Controller\UsersController;
    $controller->logout();
});

$router->get('/register', function () {
    $controller = new Controller\UsersController;
    $controller->register();
});

$router->post('/register', function () {
    $controller = new Controller\UsersController;
    $controller->register();
});


//ADMIN
$router->get('/admin/dash', function () {
    $controller = new Controller\Admin\PostsController;
    $controller->index();
});

$router->get('/admin/posts', function () {
    $controller = new Controller\Admin\PostsController;
    $controller->index();
});

$router->get('/admin/posts/:id', function ($id) {
    $controller = new Controller\Admin\PostsController;
    $controller->edit($id);
});

$router->post('/admin/dash', function () {
    $controller = new Controller\Admin\PostsController;
    $controller->delete();
});

$router->post('/admin/posts/:id', function ($id) {
    $controller = new Controller\Admin\PostsController;
    $controller->edit($id);
});

$router->get('/admin/newpost', function () {
    $controller = new Controller\Admin\PostsController;
    $controller->add();
});

$router->post('/admin/newpost', function () {
    $controller = new Controller\Admin\PostsController;
    $controller->add();
});

$router->get('/admin/users', function () {
    $controller = new Controller\Admin\UsersController;
    $controller->index();
});

$router->post('/admin/users/:slug', function ($slug) {
    $controller = new Controller\Admin\UsersController;
    $controller->$slug();
});

$router->get('/admin/comments', function () {
    $controller = new Controller\Admin\CommentsController;
    $controller->index();
});

$router->post('/admin/comments/:slug', function ($slug) {
    $controller = new Controller\Admin\CommentsController;
    $controller->$slug();
});

$router->get('/unauthorized', function () {
    $controller = new Controller\ErrorController;
    $controller->index('Accès non authorisé');
});

$router->get('/notfound', function () {
    $controller = new Controller\ErrorController;
    $controller->index("Désolé cette page n'a pas été trouvée");
});


$run = $router->run();

if ($run === false) {
    header('Location:' . App::getInstance()->getBaseUrl() . 'notfound');
}




