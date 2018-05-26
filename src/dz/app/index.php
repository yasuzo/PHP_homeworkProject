<?php  require_once "helper_functions.php"; ?>

<?= 
$templatingEngine->render(
    'layouts/layout.php', 
    [ 
        'title' => 'Index', 
        'body' => $templatingEngine->render('index_template.php', [])
    ]
);
?>