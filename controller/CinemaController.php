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
            WHERE id_movie = :id;
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

/**
 * This PHP function retrieves detailed information about an actor, including their personal details
 * and the roles they have played in movies.
 * 
 * @param int id_actor The `detailActor` function is used to retrieve and display detailed information
 * about a specific actor based on their `id_actor`. The function first connects to the database using
 * the `Connect::seConnecter()` method.
 */
    public function detailActor(int $id_actor){
        $pdo = Connect::seConnecter();

        $requestActor = $pdo -> prepare ("
            SELECT person.name, person.firstname , person.birthday , person.genre
            FROM person,actor
            WHERE person.id_person = actor.id_person AND id_actor = :id;
        ");
        $requestActor->bindParam(":id",$id_actor);
        $requestActor->execute();

        $requestRole = $pdo->prepare("
            SELECT role.name, movie.name
            FROM actor
            JOIN casting
            ON casting.id_actor = actor.id_actor
            JOIN role
            ON role.id_role = casting.id_role
            JOIN movie
            ON movie.id_movie = casting.id_movie
            WHERE actor.id_actor = :id;
        ");
        $requestRole-> bindParam(":id",$id_actor);
        $requestRole->execute();

        require "view/detailActor.php";
    }

/**
 * This PHP function retrieves details of a specific role, including the name of the role and
 * information about the actors who played that role in movies.
 * 
 * @param int id_role The `detailRole` function takes an integer parameter `` which represents
 * the ID of a role. This function retrieves the name of the role from the `role` table and the details
 * of actors who played that role from the database. Finally, it includes the `detailRole.php` view
 */
    public function detailRole(int $id_role){
        $pdo = Connect::seConnecter();

        $requestRole = $pdo -> prepare ("
            SELECT name
            FROM role
            WHERE id_role = :id
        ");
        $requestRole->bindParam(":id",$id_role);
        $requestRole->execute();

        $requestActor = $pdo -> prepare ("
            SELECT person.name, person.firstname, person.genre, movie.name
            FROM role
            JOIN casting
            ON casting.id_role = role.id_role
            JOIN actor
            ON actor.id_actor = casting.id_actor
            JOIN person
            ON person.id_person = actor.id_person
            JOIN movie
            ON movie.id_movie = casting.id_movie 
            WHERE role.id_role = :id;
        ");
        $requestActor->bindParam(":id",$id_role);
        $requestActor->execute();

        require "view/detailRole.php";
    }

/**
 * The function `listRole` retrieves all records from the `role` table and then includes a view file to
 * display the data.
 */
    public function listRole(){
        $pdo = Connect::seConnecter();
        $request = $pdo->query("
            SELECT *
            FROM role
        ");
        $request->execute(); 
        
        require "view/listRole.php";
    }

/**
 * The index function in PHP requires and includes the view/index.php file.
 */
    public function index(){
        require "view/index.php";
    }

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