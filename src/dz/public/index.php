<?php

define('ROOT', '/app/src/dz');
define('BAZA', ROOT.'/data/baza.json');

// AUTOLOAD
require_once ROOT.'/app/autoload.php';

require_once ROOT."/app/helper_functions.php";

$userRepository = new UserRepository(BAZA);
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

$respose = $controller->handle($request);
$respose->send();