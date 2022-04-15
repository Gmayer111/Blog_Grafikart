<?php

require '../vendor/autoload.php';

// Constante permettant d'obtenir le temps de chargement d'une page
// Donne le temps actuelle avec les ms
define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

if (isset($_GET['page']) && $_GET['page'] === '1') {
    // réécrire l'url sans le paramètre ?page
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    // Ne jamais modifier directement une globale, $get récupère va permettre de récupérer les param
    $get = $_GET;
    // retirer du tableau la clé 'page'
    unset($get['page']);
    $query = http_build_query($get);
    // On recompose l'url
    if (!empty($query)) {
        $uri = $uri . '?' . $query;
    }
    // retiré de façon permanente
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

$router = new App\Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'post/index', 'home')
    // [*:SLUG] => param qui sera le slug , [i:id] => param id (i pour int)
    // Ira le fichier post/show.php
    // post => nom pour url
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/blog/category', 'category/show', 'category')
    ->run();


