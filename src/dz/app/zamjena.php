<?php

require_once "funkcije.php";

$show = true;

$messages = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['ulaz']) && UPLOAD_ERR_OK === $_FILES['ulaz']['error']){
        if($_FILES['ulaz']['size'] > 1024){
            $messages[] = "Greska - datoteka prevelika!";
        }else{
            $file = $_FILES['ulaz'];
            if(($data=file_get_contents($file['tmp_name'])) === false)
                $messages[] = "Greska - nije moguće pročitati sadržaj datoteke!";
            else if(($data = transformiraj($data)) === null)
                $messages[] = "Greska - svi tagovi u datoteci moraju biti zatvoreni i moraju se zatvarati suprotno od onoga kako su se otvarali!";
            else{
                $show = false;
                header("Content-Type: application/html");
                header("Content-Disposition: attachment; filename='transformirani.html'");
            }
        }
    }
}

?>

<?php if($show): ?>
<?= 
$templatingEngine->render('layouts/layout.php',
    [
        'title' => 'Zamjena',
        'body' => $templatingEngine->render('zamjena_template.php',
            [
                'show' => $show,
                'messages' => $messages
            ]
        )
    ]
);
?>
<?php else: ?>
<?= $templatingEngine->render('zamjena_template.php', ['title' => 'Zamjena', 'show' => $show, 'data' => $data]); ?>
<?php endif; ?>