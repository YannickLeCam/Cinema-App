<?php

namespace Model;

use Model\Connect;

class ActorManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

/**
 * This PHP function retrieves all actors along with their details from a database.
 * 
 * Returns:
 *   An array of actors with their information, including the actor's ID.
 */
    public function getActors():array{
        $request = $this->pdo->query("
            SELECT person.* , id_actor
            FROM person,actor
            Where person.id_person = actor.id_person;
        ");
        $request->execute();
        return $request->fetchAll();
    }

/**
 * This PHP function retrieves details of an actor based on their ID from a database.
 * 
 * Args:
 *   id (int): The `getActorDetail` function takes an integer parameter `` which represents the
 * unique identifier of an actor. This function retrieves details of the actor such as their name,
 * first name, birthday, and genre from the database based on the provided actor ID.
 * 
 * Returns:
 *   An array containing the details (name, firstname, birthday, genre) of the actor with the specified
 * ID is being returned.
 */
    public function getActorDetail(int $id):array{
        $requestActor = $this->pdo->prepare("
            SELECT person.name, person.firstname , person.birthday , person.genre
            FROM person,actor
            WHERE person.id_person = actor.id_person AND id_actor = :id;
        ");
        $requestActor->bindParam(":id",$id);
        $requestActor->execute();
        return $requestActor->fetch();
    }

/**
 * The function retrieves the roles and corresponding movies of a specific actor from a database using
 * PHP and PDO.
 * 
 * Args:
 *   id (int): The `getRoleMovieOfActor` function takes an integer parameter `` which represents the
 * unique identifier of an actor. This function retrieves the roles and movies associated with the
 * actor identified by the provided ``. The SQL query fetches the role names and movie names by
 * joining the `actor`,
 * 
 * Returns:
 *   An array containing the names of roles and movies associated with the actor identified by the
 * provided ID.
 */
    public function getRoleMovieOfActor(int $id):array {
        $request = $this->pdo->prepare("
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
        $request-> bindParam(":id",$id);
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `insertActor` inserts actor data into the database tables `person` and `actor` and
 * returns a boolean value based on the success of the operation.
 * 
 * Args:
 *   data: The `insertActor` function you provided is responsible for inserting data into the `person`
 * and `actor` tables in a database. It first checks if the `` array is not empty, prepares and
 * executes an SQL query to insert data into the `person` table, retrieves the last inserted
 * 
 * Returns:
 *   This `insertActor` function returns a boolean value. It returns `true` if the data insertion into
 * both the `person` and `actor` tables is successful. If there is an error during the insertion
 * process, it returns `false` and sets the error message in the `['error']` variable.
 */
    public function insertActor($data):bool{
        try {
            if (!empty($data)) {
                $request = $this->pdo->prepare("
                    INSERT INTO person (
                    firstname,
                    name,
                    birthday,
                    genre)
                    VALUES(
                    :firstname,
                    :name,
                    :birthday,
                    :genre)
                ");
                $request->bindParam(':firstname',$data['firstname']);
                $request->bindParam(':name',$data['name']);
                $request->bindParam(':birthday',$data['birthday']);
                $request->bindParam('genre',$data['genre']);
                
                if ($request->execute()) {
                    $idPerson = $this->pdo->lastInsertId();
                    $requestActorInsert = $this->pdo->prepare("
                        INSERT INTO actor(
                        id_person)
                        VALUES(
                        :id_person);
                    ");
                    $requestActorInsert->bindParam(':id_person',$idPerson);
                    if ($requestActorInsert->execute()) {
                        return true;
                    }else {
                        throw new \Exception("Erreur lors de l'insertion des données dans la table 'actor'");
                    }
                }else {
                    throw new \Exception("Erreur lors de l'insertion des données dans la table 'person'");
                }
            }else{
                throw new \Exception("Les données semble etre vide . . .");
            }
        } catch (\Exception $e) {
            $_SESSION['error']=$e;
            return false;
        }
    }

}