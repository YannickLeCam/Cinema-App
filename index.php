<?php
use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name.'.php';
});

$ctrlCinema = new CinemaController();

if (isset($_GET["action"])) {
    switch ($_GET['action']) {
        case 'listMovies': 
            $ctrlCinema->listMovies();
            break;
        case 'listActors': 
            $ctrlCinema->listActors(); 
            break;
        case 'listRole':
            $ctrlCinema->listRole();
            break;
        case 'detailMovie':
            $id_movie = filter_input(INPUT_GET,"id_movie",FILTER_VALIDATE_INT);
            $ctrlCinema->detailMovie($id_movie);
            break;
        case 'detailActor':
            $id_actor = filter_input(INPUT_GET,"id_actor",FILTER_VALIDATE_INT);
            $ctrlCinema->detailActor($id_actor);
            break;
        case 'detailRole':
            $id_role = filter_input(INPUT_GET,"id_role",FILTER_VALIDATE_INT);
            $ctrlCinema->detailRole($id_role);
            break;
        default:
            //Mettre le chargement de l'index pur si pas reconnu
            break;
    }
}else {
    $ctrlCinema->index();
}
?>