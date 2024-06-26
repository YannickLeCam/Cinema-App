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
        case 'detailMovie':
            $id_movie = filter_input(INPUT_GET,"id_movie",FILTER_VALIDATE_INT);
            $ctrlCinema->detailMovie($id_movie);
            break;
        default:
            //Mettre le chargement de l'index pur si pas reconnu
            break;
    }
}
?>