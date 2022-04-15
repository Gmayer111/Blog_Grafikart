<?php

use App\Helpers\Text;
use App\Model\Post;
use App\Connection;
use App\URL;

$title = 'Mon blog';
$pdo = Connection::getPDO();

// Pagination
$page = $_GET['page'] ?? 1;

$currentPage = URL::getPositiveInt('page', 1);

$mount = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;

// Nombre total d'article / nombre d'article sur une page
$pages = ceil($mount / $perPage);
if ($currentPage > $pages) {
    throw new Exception("Numéro de page inexistante"); 
}

$offSet = $perPage * ($currentPage - 1);
$query = $pdo->query("SELECT * FROM post ORDER BY created_at DESC LIMIT $perPage OFFSET $offSet");
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);

?>


<h1>Mon super blog</h1> 

<div class="row">
    <?php foreach($posts as $post): ?>
        <?php require 'card.php'; ?>
    <?php endforeach ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?php if ($currentPage > 1): ?>
        <?php 
            $link = $router->url('home');
            if ($currentPage > 2) $link .= '?page=' . ($currentPage - 1);
        ?>
        <a href="<?= $link ?>" class="btn btn-primary">&laquo; Page précedente</a>
    <?php endif ?>    
    <?php if ($currentPage < $pages): ?>
        <a href="<?= $router->url('home') ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">Page suivante &raquo;</a>
    <?php endif ?>   
</div>


