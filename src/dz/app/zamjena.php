<?php

require_once "helper_functions.php";
require_once "funkcije.php";


ob_start();

$show = true;


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['ulaz']) && UPLOAD_ERR_OK === $_FILES['ulaz']['error']){
        if($_FILES['ulaz']['size'] > 1024){
            send_message("Greska - datoteka prevelika!");
        }else{
            $file = $_FILES['ulaz'];
            if(($data=file_get_contents($file['tmp_name'])) === false)
                send_message("Greska - nije moguće pročitati sadržaj datoteke!");
            else if(($data = transformiraj($data)) === null)
                send_message("Greska - svi tagovi u datoteci moraju biti zatvoreni i moraju se zatvarati suprotno od onoga kako su se otvarali!");
            else{
                $show = false;
                header("Content-Type: application/html");
                header("Content-Disposition: attachment; filename='transformirani.html'");
                ob_end_clean();
                echo $data;
            }
        }
    }
}

?>

<?php if($show): ?>
<?= render('zamjena_template.php', 'Zamjena'); ?>
<?php endif; ?>