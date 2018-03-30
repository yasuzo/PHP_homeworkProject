<?php

$ulaz = 123456789;

//ulaz conv
$ulaz = (string)$ulaz;

for($i = 0; isset($ulaz[$i]); $i++){
    if(!$i){
        $rez = $out = $ulaz[$i];
        continue;
    }
    $rez += (int)$ulaz[$i];
    $out .= " + " . $ulaz[$i];
}

$out .= " = $rez";

echo $out;

