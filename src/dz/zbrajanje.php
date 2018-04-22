<?php
require_once "helper_functions.php";
require_once "funkcije.php";
$show = true;
$ulaz = $_GET['ulaz'] ?? '';
if(isset($_GET['submitButton'])){
    if(passed_value_is_array($ulaz)){
        $ulaz = "";
        send_message("Greska - proslijeđen je array!");
    }else{

        if(($rez = zbroji($ulaz)) !== -1){
            send_message($rez);
            $show = false;
        }else if(empty($ulaz))
            send_message("Greska - ulazni broj je prazan!");
        else
            send_message("Greska - unos nije validan broj!");
    }
}
?>

<?php if($show): ?>
<form action="zbrajanje.php">
    <label>Broj
        <input type="text" name="ulaz" value="<?= safe($ulaz) ?>">
    </label>
    <input type="submit" value="" name="submitButton">
</form>
<?php endif; ?> 