<?php
declare(strict_types=1);
mb_internal_encoding('UTF-8');

function ponavljanje(string $ulaz, string $trazi, string ...$broji): int {
    // vraca error ako $trazi ima vise od jednog slova ili je prazan string
    // vraca error ako je $broji prazan array
    if(mb_strlen($trazi) != 1 || !isset($broji[0]))
        return -1;

    $count = 0;

    $ulaz = mb_strtolower($ulaz);
    $trazi = mb_strtolower($trazi);

    // uzima string prije znaka $trazi
    list($ulaz) = explode($trazi, $ulaz, 2);

    foreach($broji as $element){
        // vraca error ako je element u $broji prazan string ili ako ima vise od 1 znak
        // vraca error ako je element u broji jednak stop znaku
        if(mb_strlen($element) != 1)
            return -1;

        $count += mb_substr_count($ulaz, mb_strtolower($element));
    }
    return $count;
}

function zbroji(string $ulaz): int {
    // ako je broj negativan ili nije cijeli, vraća error
    // ako je $ulaz prazan, vraća error
    if((int)$ulaz < 0 || $ulaz != (int)$ulaz || empty($ulaz))
        return -1;

    $sum = 0;
    for($i = 0; $i < mb_strlen($ulaz); $i++){
        // ako se u stringu nalaze znakovi koji nisu brojke, vraca error
        if(mb_substr($ulaz, $i, 1) < '0' || mb_substr($ulaz, $i, 1) > '9')
            return -1;
        $sum += mb_substr($ulaz, $i, 1);
    }
    return $sum;
}

function transformiraj(string $ulaz): ?string {
    $ulaz = htmlentities($ulaz);
    $izlaz = "";

    $flags = ['strong' => false, 'em' => false, 'u' => false];

    for($i = 0; isset($ulaz[$i]); $i++){
        if($ulaz[$i] === '#'){
            if(!$flags['strong'])
                $izlaz .= "<strong>";
            else 
                $izlaz .= "</strong>";
            $flags['strong'] = !$flags['strong'];
        }else if($ulaz[$i] === '*'){
            if(!$flags['em'])
                $izlaz .= "<em>";
            else 
                $izlaz .= "</em>";
            $flags['em'] = !$flags['em'];
        }else if($ulaz[$i] === "'"){
            if(!$flags['u'])
                $izlaz .= "<u>";
            else 
                $izlaz .= "</u>";
            $flags['u'] = !$flags['u'];
        }else{
            $izlaz .= $ulaz[$i];
        }
    }
    
    if(in_array(true, $flags, true))
        return null;

    return $izlaz;
}

