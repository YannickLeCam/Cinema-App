<?php

namespace Controller;

use Model\Connect;

class CinemaController {
/**
 * The `newMovie` function in PHP retrieves data from the database related to movie types and actors,
 * and then loads a view for creating a new movie.
 */
    public function newMovie(){
        $pdo = Connect::seConnecter();

        $requestType = $pdo->query("
            SELECT *
            FROM type;
        ");
        
        $requestType->execute();

        $requestDirector = $pdo->query("
            SELECT person.name, person.firstname, id_director
            FROM director
            JOIN person
            ON person.id_person = director.id_person;
        ");
        $requestDirector->execute();

        $requestActor=$pdo->query("
            SELECT actor.id_actor,person.name,person.firstname
            FROM person
            JOIN actor
            ON person.id_person = actor.id_person;
        ");
        $requestActor->execute();

        $requestRole= $pdo->query("
            SELECT *
            FROM role;
        ");
        $requestRole->execute();

        require "view/newMovie.php";
    }
}






?>