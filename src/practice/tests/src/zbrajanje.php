<?php

declare(strict_types=1);

function zbrajanje(string $ulaz): int{
    if(ctype_digit($ulaz) === false)
        throw new LogicException("Nije broj!");
    for($i = 0; $i < strlen($ulaz); $i++)
        $cnt += (int)$ulaz[$i];
    return $cnt;
}