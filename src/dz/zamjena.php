<?php

require_once "helper_functions.php";
require_once "funkcije.php";

$show = true;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['ulaz']) && UPLOAD_ERR_OK === $_FILES['ulaz']['error']){
        if($_FILES['ulaz']['size'] > 1024){
            send_message("Greska - datoteka prevelika!");
        }else{
            $file = $_FILES['ulaz'];
            if(($data=file_get_contents($file['name'])) === false)
                send_message("Greska - nije moguće pročitati sadržaj datoteke!");
            else if(($data = transformiraj($data)) === null)
                send_message("Greska - datoteka sadrži nezatvorene tagove!");
            else if(($file = file_put_contents('transformirani.html', $data)) === false)
                send_message("Greska - nije moguce stvoriti novu datoteku!");
            else{
                $show = false;
                header("Content-Type: application/html");
                header("Content-Disposition: attachment; filename='transformirani.html'");
                readfile("transformirani.html");
            }
        }
    }
}

?>

<?php if($show): ?>
<form method="POST" action="zamjena.php" enctype="multipart/form-data">
    <label>
        <input type="file" name="ulaz">
    </label>
    <input type="submit" value="send">
</form>
<?php endif; ?>