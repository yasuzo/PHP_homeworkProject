<?php 

$ulaz = 'Abecedanejdedozjerimaz';

$ulaz = strtolower($ulaz);
$out = 0;

for($i = 0; isset($ulaz[$i]) && $ulaz[$i] != 'z'; $i++){
    switch($ulaz[$i]){
        case 'a':
        case 'b':
        case 'c':
            $out++;
            break;
    }
}

echo $out;
