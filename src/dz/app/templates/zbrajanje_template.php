<?php if($args[0]): ?>
<form>
    <label>Broj
        <input type="text" name="ulaz" value="<?= safe($args[1]) ?>">
    </label>
    <input type="hidden" name="controller" value="zbrajanje">
    <input type="submit" value="send" name="submitButton">
</form>
<?php endif; ?>