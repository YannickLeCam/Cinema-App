<?php
use Controller\CinemaController;
use Controller\MovieController;
use Controller\ActorController;
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

if (isset($_GET["action"])) {
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
            $id_movie = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
            $ctrlMovie->detailMovie($id_movie);
            break;
        case 'detailActor':
            $id_actor = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
            $ctrlActor->detailActor($id_actor);
            break;
        case 'detailRole':
            $id_role = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
            $ctrlRole->detailRole($id_role);
            break;
        case 'newMovie':
            $ctrlCinema->newMovie();
            break;
        case 'listTypes':
            $ctrlType->listTypes();
            break;
        case 'detailType':
            $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
            $ctrlType->detailType($id);
            break;
        default:
            //Mettre le chargement de l'index pur si pas reconnu
            break;
    }
}else {
    $ctrlCinema->index();
}
?>