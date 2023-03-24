<?php

require_once 'configuration.php';


$controllerName = Request::get('controller');


if (!$controllerName) {
    $controllerName = "status";
}

$controllerName = ucfirst($controllerName);
$controllerName = $controllerName . "Controller";
$chemin = "libraries/controllers/$controllerName.php";
if (!file_exists($chemin)) {
    Session::addFlash('error', "L'action que vous avez demandé n'existe pas !");
    Http::redirect('index.php');
}
require_once $chemin;


try {
    $controller = new $controllerName();

    $task = Request::get('task');


    if (!$task) {

        $task = "index";
    }


    if (!method_exists($controller, $task)) {
        Session::addFlash('error', "La tâche que vous avez demandé n'a pas été trouvé !");
        Http::redirect("index.php");
    }
    $controller->$task();
} catch (Exception $e) {
    $code = $e->getCode();
    $message = $e->getMessage();
    require_once 'templates/partials/header.php';
    require_once 'templates/error.php';
    require_once 'templates/partials/footer.php';
}
?>