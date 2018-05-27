<?php 

session_start();

require_once "../app/helper_functions.php";
require_once "../app/classes/templating.php";

$templatingEngine = new Templating('../app/templates/');

switch($_GET['controller'] ?? 'index'){
    case 'prijava':
        $path = '../app/prijava.php';
        break;
    case 'registracija':
        $path = '../app/registracija.php';
        break;
    case 'brojanje':
        $path = '../app/brojanje.php';
        break;
    case 'zbrajanje':
        $path = '../app/zbrajanje.php';
        break;
    case 'zamjena':
        $path = '../app/zamjena.php';
        break;
    case 'normaliziraj':
        $path = '../app/normaliziraj.php';
        break;
    case 'index':
        $path = '../app/index.php';
        break;
    default:
        $path = '../app/404.php';
}

require_once $path;
