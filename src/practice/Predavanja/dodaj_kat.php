<?php

require_once 'baza.php';

$ime = $_POST['ime'] ?? null;

if($ime = null){
    header('Location: vjezba_baza.php');
    die();
}

$statement = <<<SQL
insert into kategorija
(ime) values (:ime);
SQL;

$statement = $db->prepare($statement);
$statement->execute([':ime' => $ime]);

header('Location: vjezba_baza.php');
die();