<?php
require_once "funkcije.php";

$show = true;

$ulaz = $_GET['ulaz'] ?? '';
$trazi = $_GET['trazi'] ?? '';
$broji = $_GET['broji'] ?? '';

$messages = [];


// provjera je li bilo koji od ulaznih parametara proslijedjen kao array
if(passed_value_is_array($ulaz, $trazi, $broji)){
    $messages[] = "Greska - pokusavate poslati array!";
    $ulaz = '';
    $trazi = '';
    $broji = '';
}else if(isset($_GET['submitButton'])){
    $broji = explode(',', $broji);
    if(($rez = ponavljanje($ulaz, $trazi, ...$broji)) !== -1){
        // ako nema greske
        $messages[] = $rez;
        $show = false;
    }else{
        if(is_empty($trazi, $broji = implode(',',$broji)))
            $messages[] = "Greska - parametri su prazni!";
        else if(longer_than_one($trazi))
            $messages[] = "Greska - parametar Trazi ima vise od jednog znaka!";
        else
            $messages[] = "Greska - elementi u parametru broji moraju biti duljine jednog znaka!";
    }
}

?>


<?=
$templatingEngine->render(
    'layouts/layout.php', 
    [ 
        'title' => 'Brojanje', 
        'body' => $templatingEngine->render(
            'brojanje_template.php', 
            [ 
                'messages' => $messages,
                'show' => $show,
                'ulaz' => $ulaz, 
                'trazi' => $trazi, 
                'broji' => $broji
            ]
        )
    ]
);
?>