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
function add_to_json_file(string $key, string $data, string $jsonFile): bool{
    if(is_file($jsonFile) === false){
        touch($jsonFile);
    }
    $array = read_json_file($jsonFile);

    $array[$key] = $data;

    $array = json_encode($array, JSON_PRETTY_PRINT);

    return file_put_contents($jsonFile, $array) > 0 ? true : false;
}

// returns array decoded from json
function read_json_file(string $jsonFile): ?array{
    $array = [];
    if(is_file($jsonFile) === true){
        $array = file_get_contents($jsonFile);
        $array = json_decode($array);
    }
    return (array)$array;
}

function set_empty_string(&...$arr): void{
    array_map(function($val): string{
        return '';
    }, $arr);
}

function is_authenticated(): bool{
    return isset($_SESSION['user']);
}

function render(string $template, string $title, ...$args): void {
    $buffer = ob_get_clean();
    $template = '/app/src/dz/templates/'.$template;
    require_once './templates/layouts/layout.php';
}

function get_scripts_name(): string {
    $string = explode('/', $_SERVER['PHP_SELF']);
    $string = array_pop($string);
    return $string;
}