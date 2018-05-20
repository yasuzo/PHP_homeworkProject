<?php


function trimSpaces(string &$string): int{
    $regex = "/\s\s+/";
    $string = preg_replace($regex, ' ', $string, -1, $count);
    return $count;
}


function removeLastSpace(string &$string): int{
    $regex = "/ $/";
    $string = preg_replace($regex, '', $string, -1, $count);
    return $count;
}

function date_to_YMD(string &$string): int{
    $regex = '/(?<=\s)(0?[1-9]|[12]\d|3[01])\.(0?[1-9]|1[012])\.(\d{4})(?=\s)/';
    $string = preg_replace($regex, '${3}-${2}-${1}', $string, -1, $count);
    return $count;
}

function formatDate_YMD(string &$string): int{
    $regex = [
        '/(?<=\s\d{4}\-)(?=[1-9]\-(?:[1-9]|[12]\d|3[01])(?=\s))/',    // trazi '' nakon prve '-' u datumu gdje je samo jedna brojka
        '/(?<=\s\d{4}\-(?:0[1-9]|1[012])\-)(?=[1-9](?=\s))/'        // trazi '' nakon druge '-' u datumu gdje je samo jedno brojka
    ]; 
    $replacements = ['0', '0'];
    $string = preg_replace($regex, $replacements, $string, -1, $count);
    return $count;
}

function date_from_YMD_to_standard(string &$string): int{
    $regex = '/(?<=\s)(\d{4})\-(0[1-9]|1[012])\-(0[1-9]|[12]\d|3[01])(?=\s)/';
    $string = preg_replace($regex, '${3}.${2}.${1}', $string, -1, $count);
    return $count;
}


function addSpaceAfter(string &$string, string $chars): int{
    $chars = preg_quote($chars, '/');
    $regex = "/(?<=[$chars])(?!\s)/";
    $string = preg_replace($regex, ' ', $string, -1, $count);
    return $count;
}

function normalizeTelephoneNumber(string &$string): int{

    $prefixRegex = '(?<=^| )((?>0|\+385)(?:1|2[0-3]|3[1-5]|4[02-47-9]|5[123]|976|9[125789]|6[012459]|7[24567]|80[01]))';
    $suffixRegex = '(?= |$|[\?\!\.])';
    $regex = [
        '/'.$prefixRegex.'[\/\-\.]?(\d{4})[\/\-\.]?(\d{3})'.$suffixRegex.'/',
        '/'.$prefixRegex.'[\/\-\.]?(\d{3})[\/\-\.]?(\d)(\d{3})'.$suffixRegex.'/',
        '/'.$prefixRegex.'[\/\-\.]?(\d{3})[\/\-\.]?(\d{3})'.$suffixRegex.'/',
        '/'.$prefixRegex.'[\/\-\.]?(\d{2})[\/\-\.]?(\d)(\d)[\/\-\.]?(\d{2})'.$suffixRegex.'/',
        '/'.$prefixRegex.'[\/\-\.]?(\d{3})[\/\-\.]?(\d)(\d)[\/\-\.]?(\d{2})'.$suffixRegex.'/',
    ];

    $replacements = [
        '${1}/${2}-${3}',
        '${1}/${2}${3}-${4}',
        '${1}/${2}-${3}',
        '${1}/${2}${3}-${4}${5}',
        '${1}/${2}${3}-${4}${5}'
    ];

    $string = preg_replace($regex, $replacements, $string, -1, $count);

    return $count;
}

function normalizeEverything(string &$string): int {
    $count = trimSpaces($string);
    $count += normalizeTelephoneNumber($string);
    $count += date_to_YMD($string);
    $count += formatDate_YMD($string);
    $count += addSpaceAfter($string, '!?.,');
    $count += date_from_YMD_to_standard($string);
    $count += removeLastSpace($string);
    return $count;
}