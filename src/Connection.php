<?php

namespace App;

use PDO;

class Connection {

    public static function getPDO () : PDO
    {
        return $pdo = new PDO('mysql:dbname=tutoblog;host=localhost', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}