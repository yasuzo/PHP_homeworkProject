<?php

declare(strict_types=1);
mb_internal_encoding('UTF-8');

// returns a safe string
function safe(string $str): string {
    return htmlentities($str);
}

// provjerava je li bilo koji od argumenata prazan
function is_empty(string ...$arr): bool {
    foreach($arr as $val){
        if (empty($val))
            return true;
    }
    return false;
}

// ispisi poruku
function send_message($message): void {
    echo safe((string)$message) . "<br>";
}

// provjera ima li string vise jednog znaka
function longer_than_one(string $str): bool{
    return mb_strlen($str) > 1;
}

//provjerava je li varijabla array
function passed_value_is_array(...$arr): bool {
    foreach($arr as $val){
        if(is_array($val)){
            return true;
        }
    }
    return false;
}

// returns true on success and false on failure
function add_to_json_file(array $data, string $jsonFile){
    if(is_file($jsonFile) === false){
        touch($jsonFile);
    }
    $array = read_json_file($jsonFile);

    $array[] = $data;

    $array = json_encode($array, JSON_PRETTY_PRINT);
    if (file_put_contents($jsonFile, $array) === 0)
        throw new PersistRuntimeException('Greska - Nije moguce spremiti podatak!');
}

// returns array decoded from json
function read_json_file(string $jsonFile): ?array{
    $array = [];
    if(is_file($jsonFile) === true){
        $array = @file_get_contents($jsonFile);
        if($array === false)
            throw new UnableToOpenStreamException('Greska - Nije moguce procitati datoteku!');
        $array = json_decode($array, true);
    }
    return (array)$array;
}

function set_empty_string(&...$arr): void{
    foreach($arr as &$val){
        $val = '';
    }
}

function is_authenticated(): bool{
    return isset($_SESSION['user']);
}

// mozda sam glup
function get_scripts_name(string $path): string {
    $string = basename($path, '.php');
    return $string;
}