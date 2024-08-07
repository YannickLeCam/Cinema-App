<?php

namespace Controller;

use Model\ActorManager;
use Model\DirectorManager;

class ActorController {

    /**
 * The function `listFilm` retrieves all records from the `movie` table and then includes the
 * `listFilm.php` view file.
 */
    public function listActors(){
        $actorManager = new ActorManager();
        if (isset($_POST['SubmitSearchButton'])) {
            $content = filter_input(INPUT_POST,'nameContain',FILTER_SANITIZE_SPECIAL_CHARS);
            $listActors = $actorManager->getActorsSearch($content);
        }else {
            $listActors = $actorManager->getActors();
        }
        

        require "view/list/listActors.php";
    }

    /**
 * The function detailMovie retrieves information about a specific movie and its casting details from a
 * database using PHP and PDO.
 * 
 * @param int id_movie The code you provided seems to have a couple of errors. Here are the
 * corrections:
 */
    public function detailActor(int $id){
        $actorManager = new ActorManager();

        $actor = $actorManager->getActorDetail($id);
        $filmography = $actorManager->getRoleMovieOfActor($id);
        $productMovies = $actorManager->getProductMovies($id);

        require "view/detail/detailActor.php";
    }

/**
 * The `newActor` function in PHP creates a new actor by processing form data, validating input, and
 * inserting the actor into a database, handling success and error messages accordingly.
 */
    public function newActor(){
        $directorManager = new ActorManager();
        if (isset($_POST['SubmitActorForm'])) {
            $data=[];

            $firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
            $genre = filter_input(INPUT_POST,'genre',FILTER_SANITIZE_SPECIAL_CHARS);
            //GPT
            $birthday = filter_input(INPUT_POST, 'birthday', FILTER_VALIDATE_REGEXP, array(
                "options" => array("regexp" => '/^\d{4}-\d{2}-\d{2}$/')));
            $data['firstname']=$firstname;
            $data['name']=$name;
            $data['birthday']=$birthday;
            $data['genre']=$genre;

            if ($firstname!="" && $name != "" && $genre != "" && $birthday=!"") {
                if ($directorManager->insertActor($data)) {
                    $_SESSION['success']="L'Acteur $name $firstname a bien été enregistré";
                }else {
                    $_SESSION['error']="L'Acteur $name $firstname a eu une erreur lors de l'ajout";
                    $_SESSION['dataActor']=$data;
                    header("Location:./index.php?createActor");
                    die();
                }
            }else {
                $_SESSION["error"]="Il semble manquer un atribut . . .";
                $_SESSION['dataActor']=$data;
                header("Location:./index.php?createActor");
                die();
            }
        }

        require 'view/create/createActor.php';
    }


}