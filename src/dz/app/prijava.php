<?php

require_once 'helper_functions.php';
require_once 'validation_helpers.php';



if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== 'prijava.php'){
    $_SESSION['lastPage'] = $_SERVER['HTTP_REFERER'];
}

if(isset($_GET['odjavi-me']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
    unset($_SESSION['user']);
    header('Location: index.php');
    die();
}

if(isset($_SESSION['user'])){
    header('Location: '.($_SESSION['lastPage'] ?? 'index.php'));
    die();
}

ob_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if(passed_value_is_array($username, $password)){
        send_message("Greska - Poslan je array!");
    }else{
        if(credentials_ok($username, $password, 'baza.json')){
            ob_end_clean();
            $_SESSION['user'] = $username;
            header('Location: '.($_SESSION['lastPage'] ?? 'index.php'));
            die();
        }else{
            send_message("Username ili password nije ispravan!");
        }
    }
}

?>

<?= render('prijava_template.php', 'Prijava'); ?>
