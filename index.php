<?php
use Controller\CinemaController;
use Controller\MovieController;
use Controller\ActorController;
use Controller\DirectorController;
use Controller\RoleController;
use Controller\TypeController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$ctrlCinema = new CinemaController();
$ctrlMovie = new MovieController();
$ctrlActor = new ActorController();
$ctrlRole = new RoleController();
$ctrlType = new TypeController();
$ctrlDirector = new DirectorController();

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
        case 'listRole':
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
        case 'newMovie':
            $ctrlCinema->newMovie();
            break;
        case 'listTypes':
            $ctrlType->listTypes();
            break;
        case 'detailType':
            $ctrlType->detailType($id);
            break;
        case 'listDirector':
            $ctrlDirector->listDirectors();
            break;
        case 'detailDirector':
            $ctrlDirector->detailDirector($id);
        default:
            //Mettre le chargement de l'index pur si pas reconnu
            break;
    }
}else {
    $ctrlCinema->index();
}
?>