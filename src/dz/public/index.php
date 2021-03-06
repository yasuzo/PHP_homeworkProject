<?php

define('ROOT', '/app/src/dz');

// AUTOLOAD
require_once ROOT.'/app/autoload.php';

require_once ROOT.'/app/baza.php';

require_once ROOT."/app/helper_functions.php";
require_once ROOT."/app/validation_helpers.php";

$userRepository = new UserRepository($db);
$templatingEngine = new Templating(ROOT.'/app/templates/');
$session = new Session();
$request = new Request(
    $_SERVER['REQUEST_METHOD'], 
    $_SERVER['HTTP_REFERER'] ?? null, 
    $_GET, 
    $_POST, 
    $_FILES
);

switch($_GET['controller'] ?? 'index'){
    case 'prijava':
        $controller = new Prijava($templatingEngine, $session, $userRepository);
        break;
    case 'registracija':
        $controller = new Registracija($templatingEngine, $session, $userRepository);
        break;
    case 'brojanje':
        $controller = new Brojanje($templatingEngine, $session);
        break;
    case 'zbrajanje':
        $controller = new Zbrajanje($templatingEngine, $session);
        break;
    case 'zamjena':
        $controller = new Zamjena($templatingEngine, $session);
        break;
    case 'normaliziraj':
        $controller = new Normaliziraj($templatingEngine, $session);
        break;
    case 'index':
        $controller = new Index($templatingEngine, $session);
        break;
    default:
        $controller = new Error404($templatingEngine, $session);
}

try{
    $respose = $controller->handle($request);
    $respose->send();
}catch(Throwable $e){
    http_response_code(500);
    $response = new HTMLResponse('Greska! '.$e->getMessage());
    $response->send();
}

