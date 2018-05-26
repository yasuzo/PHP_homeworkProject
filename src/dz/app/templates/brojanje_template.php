<?php 
    foreach ($messages as $message) {
        send_message($message);
    }
?>

<?php if($show): ?>

<form>
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
    <input type="hidden" name="controller" value="brojanje">
    <input type="submit" value="send" name="submitButton">
</form>

<?php endif; ?>
