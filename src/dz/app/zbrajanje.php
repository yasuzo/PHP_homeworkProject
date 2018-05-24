<?php
require_once "helper_functions.php";
require_once "funkcije.php";



$show = true;
$ulaz = $_GET['ulaz'] ?? '';

if(passed_value_is_array($ulaz)){
    $ulaz = "";
    send_message("Greska - proslijeđen je array!");
}else if(isset($_GET['submitButton'])){
    if(($rez = zbroji($ulaz)) !== -1){
        send_message($rez);
        $show = false;
    }else if(empty($ulaz))
        send_message("Greska - ulazni parametar je prazan!");
    else
        send_message("Greska - broj mora biti >= 0 i cijeli, bez ikakvih posebnih znakova!");
}
?>

<?= render('zbrajanje_template.php', 'Zbrajanje', $show, $ulaz); ?>