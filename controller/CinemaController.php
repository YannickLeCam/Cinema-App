<?php

namespace Controller;

use Model\Connect;

class CinemaController {

/**
 * The function `listFilm` retrieves all records from the `movie` table and then includes the
 * `listFilm.php` view file.
 */
    public function listMovies(){
        $pdo = Connect::seConnecter();
        $request = $pdo->query("
            SELECT *
            FROM movie;
        ");
        $request->execute();
        
        require "view/listMovies.php";
    }
    public function listActors(){
        $pdo = Connect::seConnecter();
        $request = $pdo->query("
            SELECT *
            FROM person
            Where person.id_person = actor.id_person;
        ");
        $request->execute(); 
        
        require "view/listActors.php";
    }
}






?>