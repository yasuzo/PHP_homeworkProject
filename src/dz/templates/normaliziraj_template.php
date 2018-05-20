<?php if($args[0]): ?>
<form action="normaliziraj.php" method="post">
    <textarea name="ulaz" cols="30" rows="10"></textarea>
    <input type="submit" value="Send">
</form>
<?php else: ?>
    <?= safe($args[1]).'<br>Broj izmjena: '.$args[2]; ?>
<?php endif; ?>