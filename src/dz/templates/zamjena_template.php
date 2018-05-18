
<?php if($args[0]): ?>
<form method="POST" action="zamjena.php" enctype="multipart/form-data">
    <label>
        <input type="file" name="ulaz">
    </label>
    <input type="submit" value="send">
</form>
<a href="index.php">&lt;Povratak</a>
<?php endif; ?>