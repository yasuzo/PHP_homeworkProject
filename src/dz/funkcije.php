<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');

function ponavljanje(string $ulaz, string $trazi, string ...$broji): int {
    // vraca error ako $trazi ima vise od jednog slova ili je prazan string
    // vraca error ako je $broji prazan array
    if(mb_strlen($trazi) != 1 || !isset($broji[0]))
        return -1;
    $count = 0;
    $ulaz = explode($trazi, $ulaz, 2);
    foreach($broji as $element){
        // vraca error ako je element u $broji prazan string ili ako ima vise od 1 znak
        // vraca error ako je element u broji jednak stop znaku
        if(mb_strlen($element) != 1 || $element === $trazi)
            return -1;
        $count += substr_count($ulaz[0], $element);
    }
    return $count;
}

function zbroji(string $ulaz): int {
    // ako je broj negativan ili nije cijeli vraća error
    // ako je prvo slovo 'e' ili zadnje slovo 'e' vraća error
    // ako postoji više 'e' vraća error
    // ulazi poput "1e7" su dopusteni
    if((int)$ulaz < 0 || $ulaz != (int)$ulaz)
        return -1;
    if($ulaz[0] === 'e' || mb_substr($ulaz, -1, 1) === 'e' || mb_substr_count($ulaz, 'e') > 1)
        return -1;

    // provjerava postoje li drugi znakovi osim 'e'
    for($i = 0; $i < mb_strlen($ulaz); $i++)
    {
        if((mb_substr($ulaz, $i, 1) < '0' || mb_substr($ulaz, $i, 1) > '9') && mb_substr($ulaz, $i, 1) !== 'e')
            return -1;
    }

    // ocisti se od notacije eksponentom
    $ulaz = (string)(int)$ulaz;
    $sum = 0;
    for($i = 0; $i < mb_strlen($ulaz); $i++){
        $sum += mb_substr($ulaz, $i, 1);
    }
    return $sum;
}

function transformiraj(string $ulaz): ?string {
    $ulaz = htmlentities($ulaz)."\0";

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
    
    if(in_array(true, $flags, true));
        return null;

    return $izlaz;
}

