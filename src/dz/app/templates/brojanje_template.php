<?php if($args[0]): ?>

<form>
    <label>Ulaz:
        <input type="text" name="ulaz" value="<?= safe($args[1])?>">
    </label>
    <br>
    <label>Trazi:
        <input type="text" name="trazi" value="<?= safe($args[2])?>">
    </label>
    <br>
    <label>Broji:
        <input type="text" name="broji" value="<?= safe($args[3])?>">
    </label>
    <input type="hidden" name="controller" value="brojanje">
    <input type="submit" value="send" name="submitButton">
</form>

<?php endif; ?>
