<?php

require_once 'baza.php';

$sql = 'SELECT id, ime FROM kategorija';
$kategorija = $db->prepare($sql);
$kategorija->execute();
var_dump($kategorija->fetch());

?>
<ol>
    <?php foreach($kategorija as $kat): ?>
    <li><a href="clanci.php?kategorija_id=<?=$kat['id']?>"><?=$kat['ime']?></a></li>
    <?php endforeach;?>
</ol>
