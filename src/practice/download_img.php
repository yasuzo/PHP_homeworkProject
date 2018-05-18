<?php

if(!empty($_GET['pic_name'])){
    if(file_exists("./slike/".$_GET['pic_name'].".jpg")){
        $dontShowHTML = false;
        header("Content-Type: image/jpg");
        header("Content-Disposition: attachment; filename='".$_GET['pic_name'].".jpg'");
        readfile("./slike/".$_GET['pic_name'].".jpg", true);
         echo "Postoji datoteka ".$_GET['pic_name'].".jpg";
         ob_end_flush();

        exit();
    }else{
        echo "Datoteka ne postoji!<br>";
    }
}

?>

<?php if($dontShowHTML ?? true): ?>
<form action="download_img.php" method="GET">
    <label for="pic_name">Ime slike</label>
    <input type="text" name="pic_name">
    <input type="submit" value="send">
</form>
<?php endif;?>

