<?php
require_once 'normalizer.php';
require_once 'helper_functions.php';


if(isset($_SESSION['user']) !== true){
    header('Location: prijava.php');
    die();
}

ob_start();
$showForm = true;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ulaz = $_POST['ulaz'] ?? '';
    if(is_array($ulaz)){
        send_message("Greska - poslan je array!");
    }else{
        $showForm = false;
        $count = normalize($ulaz);
    }
}

render('normaliziraj_template.php', 'Normaliziraj', $showForm, $ulaz ?? '', $count ?? 0);

