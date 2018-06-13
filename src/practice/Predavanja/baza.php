<?php
try {
    $dsn = 'mysql:dbname=oipa-predavanja;'
    . 'host=oipa-db;charset=utf8';
    $db = new PDO(
        $dsn,
        'root',
        'oipa-password',
        [
            PDO::ATTR_DEFAULT_FETCH_MODE =>
            PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION
        ]
    );
    echo "Spojeno!";
} catch (PDOException $e) { throw $e; }
