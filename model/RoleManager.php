<?php

namespace Model;

use Model\Connect;

class RoleManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

/**
 * This PHP function retrieves all roles from a database table named "role" and returns them as an
 * array.
 * 
 * Returns:
 *   An array of all roles from the "role" table in the database is being returned.
 */
    public function getRoles():array{
        $request = $this->pdo->query("
            SELECT *
            FROM role
            ORDER BY name;
        ");
        $request->execute(); 
        return $request->fetchAll();
    }

/**
 * The function `getRoleDetail` retrieves the name of a role based on its ID from the database.
 * 
 * Args:
 *   id (int): The `getRoleDetail` function takes an integer parameter `` which represents the id of
 * the role for which you want to retrieve details. The function then prepares and executes a SQL query
 * to fetch the name of the role from the database based on the provided id. Finally, it returns an
 * array
 * 
 * Returns:
 *   The `getRoleDetail` function is returning an associative array with the role name for the given
 * `id`.
 */
    public function getRoleDetail(int $id):array{
        $requestRole = $this->pdo -> prepare ("
            SELECT name
            FROM role
            WHERE id_role = :id
        ");
        $requestRole->bindParam(":id",$id);
        $requestRole->execute();
        return $requestRole->fetch();
    }

/**
 * The function retrieves information about an actor's role in a movie based on the role ID.
 * 
 * Args:
 *   id (int): The `getActorMovieOfRole` function takes an integer parameter ``, which represents
 * the ID of a specific role. The function then retrieves information about the actor and movie
 * associated with that role from the database tables `role`, `casting`, `actor`, `person`, and
 * `movie`.
 * 
 * Returns:
 *   This function is returning an array of data that includes the name, firstname, genre of the actor,
 * and the name of the movie they are associated with based on the role ID provided as a parameter.
 */
    public function getActorMovieOfRole(int $id):array{
        $requestActor = $this->pdo -> prepare ("
            SELECT person.name AS actorName, person.firstname, person.genre, movie.name AS movieName , actor.id_actor , movie.id_movie , YEAR(movie.date_release) AS date_release
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
            ORDER BY movie.date_release
        ");
        $requestActor->bindParam(":id",$id);
        $requestActor->execute();
        return $requestActor->fetchAll();
    }

/**
 * The function `insertRole` inserts a new role into a database table named `role` using data provided
 * in an associative array.
 * 
 * Args:
 *   data (array): The `insertRole` function is designed to insert a new role into a database table
 * named `role`. The function takes an array `` as a parameter, which is expected to contain the
 * data needed to insert a new role.
 * 
 * Returns:
 *   The `insertRole` function returns a boolean value. It returns `true` if the role insertion is
 * successful, and `false` if there is an error during the insertion process.
 */
    public function insertRole(array $data):bool{
        try {
            $request = $this->pdo->prepare("
                INSERT INTO role
                (name)
                VALUES(
                :name
                );
            ");
            $request->bindParam(':name',$data['name']);
            if ($request->execute()) {
                return true;
            }else {
                return false;
            }
        } catch (\Exception $e) {
            $_SESSION["error"]=$e->getMessage();
            return false;
        }

    }
    
/**
 * The function `getRolesSearch` retrieves roles from a database that match a given search content.
 * 
 * Args:
 *   content (string): The `getRolesSearch` function takes a string parameter named ``, which
 * is used to search for roles in a database table named `role`. The function prepares a SQL query to
 * select all columns from the `role` table where the `name` column is like the provided content. The
 * content
 * 
 * Returns:
 *   An array of roles that match the search content provided.
 */

    public function getRolesSearch(string $content):array{
        $content = '%'. $content . '%';
        $request = $this->pdo->prepare("
            SELECT *
            FROM role
            WHERE name LIKE :content;
            ORDER BY name
        ");
        $request->bindParam(":content",$content);
        $request->execute(); 
    return $request->fetchAll();
    }

}


?>