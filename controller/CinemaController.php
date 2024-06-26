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

/**
 * The function `listActors` retrieves a list of actors from a database and then displays them using a
 * view file.
 */
    public function listActors(){
        $pdo = Connect::seConnecter();
        $request = $pdo->query("
            SELECT person.*
            FROM person,actor
            Where person.id_person = actor.id_person;
        ");
        $request->execute(); 
        
        require "view/listActors.php";
    }

/**
 * The function detailMovie retrieves information about a specific movie and its casting details from a
 * database using PHP and PDO.
 * 
 * @param int id_movie The code you provided seems to have a couple of errors. Here are the
 * corrections:
 */
    public function detailMovie(int $id_movie){
        $pdo = Connect::seConnecter();

        $requestMovie = $pdo->prepare("
            SELECT *
            FROM movie
            WHERE id_movie = :id
        ");
        $requestMovie->bindParam(":id",$id_movie);
        $requestMovie->execute();

        $requestCasting = $pdo->prepare("
            SELECT role.name , CONCAT(person.name,' ',person.firstname) AS Actor
            FROM casting
            JOIN actor
            ON actor.id_actor = casting.id_actor
            JOIN person
            ON person.id_person = actor.id_person
            JOIN role
            ON role.id_role = casting.id_role
            WHERE id_movie = :id;
        ");
        $requestCasting->bindParam(":id",$id_movie);
        $requestCasting->execute();

        require "view/detailMovie.php";
    }
}






?>