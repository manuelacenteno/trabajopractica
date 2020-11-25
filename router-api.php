<?php
//incluyo el router de la libreria
include_once 'libs/Router.php';
include_once 'app/api/api-comments.controller.php';

//creo el nuevo router
$router = new Router();

//defino la tabla de ruteo (case)
$router->addRoute('adminComentarios', 'GET', 'ApiCommentsController', 'getAll');
$router->addRoute('comentarios', 'GET', 'ApiCommentsController', 'getAll');
$router->addRoute('comentarios/:ID', 'GET', 'ApiCommentsController', 'get');
$router->addRoute('comentarios/:ID', 'DELETE', 'ApiCommentsController', 'delete');
$router->addRoute('comentarios', 'POST', 'ApiCommentsController', 'add');
$router->addRoute('comentarios/:ID', 'PUT', 'ApiCommentsController', 'update');

//rutear
$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);