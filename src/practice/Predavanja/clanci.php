<?php
require_once 'baza.php';

$kategorija_id = $db->quote(
    $_GET['kategorija_id'] ?? '0',
    PDO::PARAM_INT
);

$query = "SELECT * FROM clanak WHERE kategorija_id = $kategorija_id ORDER BY naslov ASC";

$clanci = $db->query($query);

?>

<ol>
    <?php foreach($clanci as $clan): ?>
    <li><?=$clan['naslov']?></li>
    <?php endforeach;?>
</ol>



