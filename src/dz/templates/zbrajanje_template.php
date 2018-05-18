<?php if($args[0]): ?>
<form action="zbrajanje.php">
    <label>Broj
        <input type="text" name="ulaz" value="<?= safe($args[1]) ?>">
    </label>
    <input type="submit" value="send" name="submitButton">
</form>
<?php endif; ?>

<a href="index.php">&lt;Povratak</a>