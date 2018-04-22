<?php
require_once "helper_functions.php";
require_once "funkcije.php";

$show = true;

$ulaz = $_GET['ulaz'] ?? '';
$trazi = $_GET['trazi'] ?? '';
$broji = $_GET['broji'] ?? '';

if(isset($_GET['submitButton'])){
    $broji = explode(',', $broji);

    if(($rez = ponavljanje($ulaz, $trazi, ...$broji)) !== -1){
        // ako nema greske
        send_message($rez);
        $show = false;
    }else{
        if(is_empty($trazi, $broji = implode(',',$broji)))
            send_message("Greska - parametri su prazni!");
        else if(longer_than_one($trazi))
            send_message("Greska - parametar Trazi ima vise od jednog znaka!");
        else
            send_message("Greska - neki od elemenata u parametru Broji imaju vise od jednog znaka!");
    }
}

?>



<?php if($show): ?>

<form action="brojanje.php">
    <label>Ulaz:
        <input type="text" name="ulaz" value="<?= safe($ulaz)?>">
    </label>
    <br>
    <label>Trazi:
        <input type="text" name="trazi" value="<?= safe($trazi)?>">
    </label>
    <br>
    <label>Broji:
        <input type="text" name="broji" value="<?= safe($broji)?>">
    </label>
    <input type="submit" value="send" name="submitButton">
</form>

<?php endif; ?>