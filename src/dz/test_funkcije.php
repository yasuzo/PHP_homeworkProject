<?php
require_once 'funkcije.php';

echo "OVO JE U BRANCHU mod-funkcije<br>";

// ponavljanje()

echo ponavljanje("abcdefhij", "c", "a", "h").'<br>';
echo ponavljanje("žđščćžđš", "ć", "ž", "š").'<br>';
echo ponavljanje("abcdef", "a ", "b").'<br>';
echo ponavljanje("abcdef", "a", "b", "c ").'<br>';
echo ponavljanje("!@#$%", "$", "!", "@").'<br>';
echo ponavljanje("abcdefghij", "l", "a", "b").'<br>';

// zbroji()

echo '<br>';
echo zbroji("12345").'<br>';
echo zbroji("12e345").'<br>';
echo zbroji("12.345").'<br>';
echo zbroji("12345 ").'<br>';
echo zbroji("-12").'<br>';
echo zbroji("00000").'<br>';
echo zbroji("9999999").'<br>';
echo zbroji("123456789123456789123456789").'<br>';

// transformiraj()

var_dump(transformiraj("#hi#"));
var_dump(transformiraj("<b>#hi#</b>"));
var_dump(transformiraj("*hi*"));
var_dump(transformiraj("'hi'"));
var_dump(transformiraj("#hi"));
var_dump(transformiraj("*hi#hi*hi#"));
var_dump(transformiraj("#hi#hi#hi#"));
var_dump(transformiraj("#hi#hi*hi#"));
var_dump(transformiraj('"#$#"'));
var_dump(transformiraj("*hi#hi#hi*"));
var_dump(transformiraj("*#'a'#*"));
var_dump(transformiraj("đ*s#ć'čć'đ#ž*č"));