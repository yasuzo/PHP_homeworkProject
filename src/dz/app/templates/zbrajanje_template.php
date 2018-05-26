<?php 
    foreach ($messages as $message) {
        send_message($message);
    }
?>

<?php if($show): ?>
<form>
    <label>Broj
        <input type="text" name="ulaz" value="<?= safe($ulaz) ?>">
    </label>
    <input type="hidden" name="controller" value="zbrajanje">
    <input type="submit" value="send" name="submitButton">
</form>
<?php endif; ?>