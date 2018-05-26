<?php
require_once "funkcije.php";

$messages = [];

$show = true;
$ulaz = $_GET['ulaz'] ?? '';

if(passed_value_is_array($ulaz)){
    $ulaz = "";
    $messages[] = "Greska - proslijeđen je array!";
}else if(isset($_GET['submitButton'])){
    if(($rez = zbroji($ulaz)) !== -1){
        $messages[] = $rez;
        $show = false;
    }else if(empty($ulaz))
        $messages[] = "Greska - ulazni parametar je prazan!";
    else
        $messages[] = "Greska - broj mora biti >= 0 i cijeli, bez ikakvih posebnih znakova!";
}

?>

<?=
$templatingEngine->render('layouts/layout.php',
    [
        'title' => 'Zbrajanje',
        'body' => $templatingEngine->render('zbrajanje_template.php',
            [
                'show' => $show,
                'messages' => $messages,
                'ulaz' => $ulaz
            ]
        )
    ]
); 
        
?>