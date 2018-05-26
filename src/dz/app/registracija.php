<?php
require_once 'validation_helpers.php';

define('BAZA', '../data/baza.json');

$messages = [];

if(isset($_SESSION['user'])){
    header('Location: index.php');
    die();
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'] ?? '';
    $pass1 = $_POST['pass1'] ?? '';
    $pass2 = $_POST['pass2'] ?? '';

    $errors = [];

    if(passed_value_is_array($username, $pass1, $pass2)){
        $messages[] = "Greska - Poslan je array!";
        set_empty_string($username, $pass1, $pass2);
    }else{
        validate_username($username, $errors);
        validate_passwords($pass1, $pass2, $errors);
        username_taken($username, BAZA, $errors);
        if(empty($errors) === false){
            foreach($errors as $val){
                $messages[] = $val;
            }
        }else{
            $pass1 = password_hash($pass1, PASSWORD_BCRYPT);
            add_to_json_file($username, $pass1, BAZA);
            $_SESSION['user'] = $username;
            header('Location: index.php');
            die();
        }
    }
}


?>

<?=
$templatingEngine->render(
    'layouts/layout.php', 
    [ 
        'title' => 'Registracija', 
        'body' => $templatingEngine->render(
            'registracija_template.php', 
            [ 
                'messages' => $messages,
            ]
        )
    ]
);
?>