<?php

namespace Controller;

use Model\ActorManager;

class ActorController {

    /**
 * The function `listFilm` retrieves all records from the `movie` table and then includes the
 * `listFilm.php` view file.
 */
    public function listActors(){
        $actorManager = new ActorManager();

        $listActors = $actorManager->getActors();

        require "view/listActors.php";
    }

    /**
 * The function detailMovie retrieves information about a specific movie and its casting details from a
 * database using PHP and PDO.
 * 
 * @param int id_movie The code you provided seems to have a couple of errors. Here are the
 * corrections:
 */
    public function detailActor(int $id_movie){
        $actorManager = new ActorManager();

        $actor = $actorManager->getActorDetail($id_movie);
        $filmography = $actorManager->getRoleMovieOfActor($id_movie);

        require "view/detailActor.php";
    }


}