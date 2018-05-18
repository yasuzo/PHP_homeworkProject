<?php

class Demo{
    public $broj = 123;
}

$obj1 = new Demo();
$obj2 = new Demo();

$var = $obj1;

var_dump($obj1 == $obj2);
var_dump($obj1 === $obj2);
var_dump($var);

var_dump($obj1->broj);