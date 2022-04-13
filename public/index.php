<?php

require '../vendor/autoload.php';

// Constante permettant d'obtenir le temps de chargement d'une page
// Donne le temps actuelle avec les ms
define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new App\Router(dirname(__DIR__) . '/views');
$router
    ->get('/', 'post/index', 'home')
    // [*:SLUG] => param qui sera le slug , [i:id] => param id (i pour int)
    // Ira le fichier post/show.php
    // post => nom pour url
    ->get('/blog/[*:slug]-[i:id]', 'post/show', 'post')
    ->get('/blog/category', 'category/show', 'category')
    ->run();


