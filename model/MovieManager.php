<?php

namespace Model;

use Model\Connect;

class MovieManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

/**
 * This PHP function retrieves all movies from a database table named "movie".
 * 
 * Returns:
 *   An array of all movies from the database table "movie" is being returned.
 */
    public function getMovies():array{
        $request = $this->pdo->query("
            SELECT *
            FROM movie
            ORDER BY movie.date_release DESC;
        ");
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `getMovieDetail` retrieves details of a movie based on its ID from a database table
 * named `movie`.
 * 
 * Args:
 *   id (int): The `getMovieDetail` function takes an integer parameter `` which represents the ID
 * of the movie for which you want to retrieve details from the database. The function then prepares
 * and executes a SQL query to fetch all columns of the movie with the specified ID from the `movie`
 * table in the
 * 
 * Returns:
 *   The `getMovieDetail` function is returning the details of a movie with the specified ID. It
 * fetches the movie record from the database based on the provided ID and returns the result as an
 * associative array containing all the columns of the movie table for that specific movie.
 */
    public function getMovieDetail(int $id){
        $requestMovie = $this->pdo->prepare("
            SELECT *
            FROM movie
            WHERE id_movie = :id;
        ");
        $requestMovie->bindParam(":id",$id);
        $requestMovie->execute();


        return $requestMovie->fetch();
    }

/**
 * This PHP function retrieves the types of a movie based on its ID from a database.
 * 
 * Args:
 *   id (int): The `getTypesOfMovie` function takes an integer parameter `` which represents the ID
 * of a movie. This function retrieves the types of the movie with the given ID from the database by
 * executing a SQL query that joins the `type` table with the `be` table based on the `
 * 
 * Returns:
 *   The `getTypesOfMovie` function is returning an array of all the types associated with a specific
 * movie ID. It fetches the types from the `type` table by joining it with the `be` table on the
 * `id_type` column and filtering the results based on the provided movie ID.
 */
    public function getTypesOfMovie (int $id){
        $request = $this->pdo->prepare("
            SELECT type.*
            FROM type
            JOIN be
            ON be.id_type = type.id_type
            WHERE id_movie = :id;
        ");
        $request->bindParam(':id',$id);
        $request->execute();
        return $request->fetchAll();
    }

/**
 * This PHP function retrieves the roles of actors in a movie based on the movie ID.
 * 
 * Args:
 *   id (int): The `getActorRoleOfMovie` function retrieves the roles of actors in a specific movie
 * based on the movie ID provided as a parameter. The SQL query selects the role name and the full name
 * of the actor by joining the `casting`, `actor`, `person`, and `role` tables.
 * 
 * Returns:
 *   The `getActorRoleOfMovie` function is returning an array of associative arrays, where each array
 * represents a row from the result set of the SQL query. Each associative array contains two keys:
 * 'name' which represents the role name, and 'Actor' which represents the concatenated full name of
 * the actor.
 */
    public function getActorRoleOfMovie(int $id):array{
        $requestCasting = $this->pdo->prepare("
            SELECT role.name , CONCAT(person.name,' ',person.firstname) AS Actor , actor.id_actor, role.id_role, person.genre
            FROM casting
            JOIN actor
            ON actor.id_actor = casting.id_actor
            JOIN person
            ON person.id_person = actor.id_person
            JOIN role
            ON role.id_role = casting.id_role
            WHERE id_movie = :id;
        ");
        $requestCasting->bindParam(":id",$id);
        $requestCasting->execute();
        return $requestCasting->fetchAll();
    }

/**
 * The function `getDirectorOfMovie` retrieves the director of a movie based on the movie's ID.
 * 
 * Args:
 *   id (int): The `getDirectorOfMovie` function is designed to retrieve information about the director
 * of a movie based on the provided movie ID. The function executes a SQL query that joins the `movie`,
 * `director`, and `person` tables to fetch details about the director associated with the given movie
 * ID.
 * 
 * Returns:
 *   The `getDirectorOfMovie` function is returning the details of the director of a movie with the
 * specified ID. The function executes a SQL query to fetch the details of the director associated with
 * the movie ID provided as a parameter. The query joins the `movie`, `director`, and `person` tables
 * to retrieve the information. The function then fetches and returns the result of the query, which
 */
    public function getDirectorOfMovie(int $id){
        $request = $this->pdo->prepare("
            SELECT person.*,movie.id_director
            FROM movie
            JOIN director
            ON director.id_director = movie.id_director
            JOIN person
            ON person.id_person = director.id_person
            WHERE id_movie = :id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetch();
    }

/**
 * The function `insertMovie` inserts a new movie record into a database along with its associated
 * types, handling exceptions and returning true on success or false on failure.
 * 
 * Args:
 *   data: Based on the provided code snippet, the `insertMovie` function is responsible for inserting
 * a new movie record into the database along with its associated types. The function takes an array
 * `` as a parameter, which contains the following keys:
 * 
 * Returns:
 *   The `insertMovie` function returns a boolean value. It returns `true` if the movie insertion and
 * type linking are successful, and it returns `false` if there are any exceptions caught during the
 * process.
 */
    public function insertMovie($data){
        /**
         * V1 without casting's relations 
         */
        try {
            if (!empty($data)) {
                $request= $this->pdo->prepare("
                    INSERT INTO movie (
                    name,
                    date_release,
                    duration,
                    synopsis,
                    poster,
                    rate,
                    id_director)
                    VALUES (
                    :name,
                    :date_release,
                    :duration,
                    :synopsis,
                    :poster,
                    :rate,
                    :id_director);
                ");
                $request->bindParam(':name',$data['name']);
                $request->bindParam(':date_release',$data['date_release']);
                $request->bindParam(':duration',$data['duration']);
                $request->bindParam(':synopsis',$data['synopsis']);
                $request->bindParam(':poster',$data['poster']);
                $request->bindParam(':rate',$data['rate']);
                $request->bindParam(':id_director',$data['id_director']);
                if ($request->execute()) {
                    $idNewMovie=$this->pdo->lastInsertId();
                    $requestTypeLink = $this->pdo->prepare("
                        INSERT INTO be(
                        id_movie,
                        id_type)
                        VALUES (
                        :id_movie,
                        :id_type);
                    ");
                    foreach ($data["types"] as $id_type) {
                        $requestTypeLink->bindParam(':id_movie',$idNewMovie);
                        $requestTypeLink->bindParam(':id_type',$id_type);
                        if(!$requestTypeLink->execute()){
                            throw new \Exception("L'insertion du genre semble avoir échoué . . .");
                        }
                    }
                    return true;
                }else {
                    throw new \Exception("L'insertion du film semble avoir échoué . . .");
                }
            }else {
                throw new \Exception("Les données semble etre vide . . .");
            }
        } catch (\Exception $e) {
            $_SESSION["error"]=$e->getMessage();
            return false;
        }

    }

/**
 * This PHP function inserts a link between an actor, a movie, and a role into a database table called
 * "casting".
 * 
 * Args:
 *   data (array): Based on the provided code snippet, the `insertLinkCasting` function is responsible
 * for inserting a new record into the `casting` table in the database. The function takes an array
 * `` as a parameter, which is expected to contain the following keys: 'role', 'movie', and
 * 
 * Returns:
 *   The `insertLinkCasting` function returns a boolean value. It returns `true` if the insertion into
 * the `casting` table is successful, and `false` if there is an error during the execution or if the
 * insertion fails.
 */
    public function insertLinkCasting(array $data):bool{
        try {
            $request = $this->pdo->prepare("
                INSERT INTO casting(
                id_actor,
                id_movie,
                id_role
                )VALUES(
                :id_actor,
                :id_movie,
                :id_role
                );
            ");
            $request->bindParam(':id_role',$data['role']);
            $request->bindParam(':id_movie',$data['movie']);
            $request->bindParam(':id_actor',$data['actor']);
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
 * The function `getMoviesSearch` retrieves movies from a database that match a given search content.
 * 
 * Args:
 *   content (string): The `getMoviesSearch` function takes a string parameter named `$content`, which
 * is used to search for movies in a database table named `movie`. The function prepares a SQL query to
 * select all columns from the `movie` table where the `name` column is like the provided content
 * 
 * Returns:
 *   An array of movies that match the search content provided.
 */
    public function getMoviesSearch(string $content):array{
        $content = "%".$content."%";
        $request = $this->pdo->prepare("
            SELECT *
            FROM movie
            WHERE name LIKE :content;
        ");
        $request->bindParam(":content",$content);
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `updateMovie` updates a movie record in a database with the provided data and handles
 * related records for movie genres.
 * 
 * Args:
 *   id (int): The `updateMovie` function you provided seems to be updating a movie record in a
 * database. The function takes two parameters: `$id`, which is the ID of the movie to be updated, and
 * `$data`, which is an array containing the updated movie information.
 *   data (array): Based on the provided code snippet, it seems like you are trying to update a movie
 * record in a database along with related records in other tables. The `updateMovie` function takes an
 * `$id` representing the movie ID and an array `$data` containing the updated movie information.
 * 
 * Returns:
 *   This function returns a boolean value. It returns `true` if the movie update operation is
 * successful, and `false` if there is an error during the update process.
 */
    public function updateMovie(int $id,array $data):bool{
        var_dump($data);

        try {
            $request = $this->pdo->prepare("
                UPDATE movie
                SET 
                name = :name,
                date_release = :date_release,
                duration = :duration,
                synopsis = :synopsis,
                poster = :poster,
                rate = :rate,
                id_director = :director
                WHERE id_movie = :id_movie;
            ");
            $request->bindParam(':name',$data['name']);
            $request->bindParam(':date_release',$data["date_release"]);
            $request->bindParam(':duration',$data['duration']);
            $request->bindParam(':synopsis',$data['synopsis']);
            $request->bindParam(':poster',$data['poster']);
            $request->bindParam(':rate',$data['rate']);
            $request->bindParam(':director',$data['id_director']);
            $request->bindParam('id_movie',$id);

            if($request->execute()){

                $request = $this->pdo->prepare("
                    DELETE FROM be
                    WHERE id_movie=:id;
                ");
                $request->bindParam(':id',$id);
                $request->execute();
                $request= $this->pdo->prepare('
                        INSERT INTO be(
                        id_movie,
                        id_type)
                        VALUES (
                        :id_movie,
                        :id_type);
                ');

                foreach ($data['types'] as $idType) {
                    $request->bindParam(':id_movie',$id);
                    $request->bindParam(':id_type',$idType);
                    if(!$request->execute()){
                        throw new \Exception("L'insertion du genre semble avoir échoué . . .");
                    }
                }
                return true;


            }else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}