<?= $data ?? ''?>

<?php if($show): ?>
<?php
    foreach($messages as $message){
        send_message($message);
    }
?>
<form method="POST" action="?controller=zamjena" enctype="multipart/form-data">
    <label>
        <input type="file" name="ulaz">
    </label>
    <input type="submit" value="send">
</form>
<?php endif;?>