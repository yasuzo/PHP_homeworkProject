<?php 
    foreach ($messages as $message) {
        send_message($message);
    }
?>
<?php if($show): ?>
<form action="?controller=normaliziraj" method="post">
    <textarea name="ulaz" cols="30" rows="10"></textarea>
    <input type="submit" value="Send">
</form>
<?php else: ?>
    <?= safe($output).'<br>Broj izmjena: '.$count; ?>
<?php endif; ?>