<?php
session_start();

use Controller\CinemaController;
use Controller\MovieController;
use Controller\ActorController;
use Controller\DirectorController;
use Controller\HomeController;
use Controller\RoleController;
use Controller\TypeController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$ctrlMovie = new MovieController();
$ctrlActor = new ActorController();
$ctrlRole = new RoleController();
$ctrlType = new TypeController();
$ctrlDirector = new DirectorController();
$ctrlHome = new HomeController();

if (isset($_GET["action"])) {
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
    }else {
        $id=null;
    }
    switch ($_GET['action']) {
        case 'listMovies': 
            $ctrlMovie->listMovies();
            break;
        case 'listActors': 
            $ctrlActor->listActors(); 
            break;
        case 'listRoles':
            $ctrlRole->listRole();
            break;
        case 'detailMovie':
            $ctrlMovie->detailMovie($id);
            break;
        case 'detailActor':
            $ctrlActor->detailActor($id);
            break;
        case 'detailRole':
            $ctrlRole->detailRole($id);
            break;
        case 'listTypes':
            $ctrlType->listTypes();
            break;
        case 'detailType':
            $ctrlType->detailType($id);
            break;
        case 'listDirectors':
            $ctrlDirector->listDirectors();
            break;
        case 'detailDirector':
            $ctrlDirector->detailDirector($id);
            break;
        case 'createType':
            $ctrlType->newType();
            break;
        case 'createRole':
            $ctrlRole->newRole();
            break;
        case 'createDirector':
            $ctrlDirector->newDirector();
            break;
        case 'createActor':
            $ctrlActor->newActor();
            break;
        case 'createMovie':
            $ctrlMovie->newMovie();
            break;
        case 'editMovie':
            $ctrlMovie->editMovie($id);
            break;
        case 'createCasting':
            $ctrlMovie->createCasting();
            break;
        default:
            $ctrlHome->index();
            break;
    }
}else {
    $ctrlHome->index();
}
?>


