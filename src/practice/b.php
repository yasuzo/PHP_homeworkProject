<?php
declare(strict_types=1);
namespace abeceda;

function pathFromFqn(string $fqn): string {
    return __DIR__ . DIRECTORY_SEPARATOR
        . 'autoload' . DIRECTORY_SEPARATOR
        . str_replace(
            '\\', DIRECTORY_SEPARATOR, $fqn
        ) . '.php';
}

function isFileNotAccessible(string $path): bool {
    return !is_file($path)
        ||
        !is_readable($path);
}

spl_autoload_register(
    function (string $fqn) {
        $path = pathFromFqn($fqn);

        if (isFileNotAccessible($path)) {
            return ;
        }

        (function (string $path) {
            require_once $path;
        })($path);
    }
);

$a = new \A();

$string = $a->p(1);

var_dump($string);
var_dump(__DIR__);