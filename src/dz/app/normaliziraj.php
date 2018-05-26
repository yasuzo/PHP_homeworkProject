<?php
require_once 'normalizer.php';

$messages = [];

if(isset($_SESSION['user']) !== true){
    header('Location: prijava.php');
    die();
}
$showForm = true;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $ulaz = $_POST['ulaz'] ?? '';
    if(is_array($ulaz)){
        $messages[] = "Greska - poslan je array!";
    }else{
        $showForm = false;
        $count = normalize($ulaz);
    }
}
?>

<?= 
$templatingEngine->render(
    'layouts/layout.php', 
    [ 
        'title' => 'Normaliziraj', 
        'body' => $templatingEngine->render(
            'normaliziraj_template.php', 
            [
                'messages' => $messages, 
                'output' => $ulaz ?? '', 
                'count' => $count ?? '', 
                'show' => $showForm
            ]
        )
    ]
);
?>

