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

    $length_ulaz = mb_strlen($ulaz);

    // uzima string prije znaka $trazi
    list($ulaz) = explode($trazi, $ulaz, 2);

    foreach($broji as $element){
        // vraca error ako je element u $broji prazan string ili ako ima vise od 1 znak
        // vraca error ako je element u broji jednak stop znaku
        if(mb_strlen($element) != 1)
            return -1;

        $count += mb_substr_count($ulaz, mb_strtolower($element));
    }

    // ako se $trazi ne nalazi u nizu baca 0
    if(mb_strlen($ulaz) === $length_ulaz)
        return 0;

    return $count;
}

function zbroji(string $ulaz): int {
    // ako je $ulaz prazan, vraća error
    if(empty($ulaz))
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

    $stack = [];

    for($i = 0; isset($ulaz[$i]); $i++){
        switch($ulaz[$i]){
            case '#':
                if(!in_array('strong', $stack)){
                    $stack[] = 'strong';
                    $izlaz .= "<strong>";
                }else if(array_pop($stack) === 'strong')
                    $izlaz .= "</strong>";
                else
                    return null;
                break;
            case '*':
                if(!in_array('em', $stack)){
                    $stack[] = 'em';
                    $izlaz .= "<em>";
                }else if(array_pop($stack) === 'em')
                    $izlaz .= "</em>";
                else
                    return null;
                break;
            case '\'':
                if(!in_array('u', $stack)){
                    $stack[] = 'u';
                    $izlaz .= "<u>";
                }else if(array_pop($stack) === 'u')
                    $izlaz .= "</u>";
                else
                    return null;
                break;
            default:
                $izlaz .= $ulaz[$i];
        }
    }
    if(!empty($stack))
        return null;
    return $izlaz;
}

