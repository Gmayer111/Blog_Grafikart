<?php

use App\Helpers\Text;
use App\Model\Post;

$title = 'Mon blog';

$pdo = new PDO('mysql:dbname=tutoblog;host=localhost', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// Pagination
$currentPage = (int)($_GET['page'] ?? 1) ?: 1;
if ($currentPage === 0) {
    throw new Exception("Numéro de page invalide");
    
}
$mount = (int)$pdo->query('SELECT COUNT(id) FROM post')->fetch(PDO::FETCH_NUM)[0];

$query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
$posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);

?>


<h1>Mon super blog</h1> 

<div class="row">
    <?php foreach($posts as $post): ?>
        <?php require 'card.php'; ?>
    <?php endforeach ?>
</div>



