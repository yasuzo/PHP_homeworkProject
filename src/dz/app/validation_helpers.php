<?php

declare(strict_types=1);

require_once 'helper_functions.php';

define('MIN_LEN_USER', 1);
define('MAX_LEN_USER', 24);


function validate_username(string $username, array &$errors): bool{
    $regex = "/^(?=[\w\-]*[a-zA-Z])[\w\-]{".MIN_LEN_USER.",".MAX_LEN_USER."}$/";
    if((bool)preg_match($regex, $username) === false){
        array_push($errors, "Username nije valjan!");
        return false;
    }
    return true;
}

function validate_passwords(string $pass1, string $pass2, array &$errors): bool{
    $regex = "/.{12,}/";
    if((bool)preg_match($regex, $pass1) === false){
        array_push($errors, "Password nije valjan!");
        return false;
    }else if($pass1 !== $pass2){
        array_push($errors, "Passwordi nisu isti!");
        return false;
    }
    return true;
}

function username_taken(string $username, string $baza, array &$errors): bool{
    if(empty((new UserRepository('/app/src/dz/data/baza.json'))->findByUsername($username)) === false){
        array_push($errors, "Username vec postoji!");
        return true;
    }
    return false;
}