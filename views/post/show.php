<?php

use App\Connection;
use App\Model\Post;

 $id = (int)$params['id'];
 $slug = $params['slug'];
 $pdo = Connection::getPDO();

$query = $pdo->prepare('SELECT * FROM post WHERE id = :id');
$query->execute(['id' => $id]);
$query->setFetchMode(PDO::FETCH_CLASS, Post::class);
// [0] ne renvoie que le premier résultat
$post = $query->fetch();

if ($post === false) {
    throw new Exception("Aucun article ne correspond à cet ID");
    
}
