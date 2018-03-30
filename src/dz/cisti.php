<?php

$ulaz = "''underlined'' **strong** *italic* **''strong i podcrtano''** *''italic i podcrtano''* ***strong i em***";
$izlaz = "";

$ulaz .= "\0";

$flags = ['strong' => false, 'em' => false, 'u' => false];

for($i = 0; isset($ulaz[$i]); $i++){
    if($ulaz[$i] === '*' && $ulaz[$i + 1] === '*'){
        if(!$flags['strong'])
            $izlaz .= "<strong>";
        else 
            $izlaz .= "</strong>";
        $flags['strong'] = !$flags['strong'];
        $i++;
    }else if($ulaz[$i] === '*'){
        if(!$flags['em'])
            $izlaz .= "<em>";
        else 
            $izlaz .= "</em>";
        $flags['em'] = !$flags['em'];
    }else if($ulaz[$i] === "'" && $ulaz[$i + 1] === "'"){
        if(!$flags['u'])
            $izlaz .= "<u>";
        else 
            $izlaz .= "</u>";
        $flags['u'] = !$flags['u'];
        $i++;
    }else{
        $izlaz .= $ulaz[$i];
    }
}

echo $izlaz;