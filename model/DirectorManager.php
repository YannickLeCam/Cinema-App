<?php

namespace Model;

use Exception;
use Model\Connect;

class DirectorManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

/**
 * This PHP function retrieves a list of directors along with their information from a database.
 * 
 * Returns:
 *   The `getDirectors` function is returning an array of all directors from the database. The query
 * selects all columns from the `person` table and the `id_director` column from the `director` table
 * where the `id_person` matches between the two tables. The function then executes the query and
 * returns all the fetched rows as an array.
 */
    public function getDirectors():array{
        $request = $this->pdo->query("
            SELECT person.* , id_director
            FROM person,director
            Where person.id_person = director.id_person;
        ");
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `getDirectorDetail` retrieves details of a director based on their ID from a database.
 * 
 * Args:
 *   id (int): The `getDirectorDetail` function takes an integer parameter `` which represents the
 * unique identifier of a director. The function retrieves details of the director such as their name,
 * first name, birthday, genre, and director ID from the database based on the provided ``.
 * 
 * Returns:
 *   The `getDirectorDetail` function is returning a single row of data from the database that includes
 * the name, firstname, birthday, genre, and id_director of a director based on the provided ``.
 */
    public function getDirectorDetail(int $id){
        $request = $this->pdo->prepare("
            SELECT person.name, person.firstname , person.birthday , person.genre , id_director
            FROM person,director
            WHERE person.id_person = director.id_person AND id_director = :id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetch();
    }

/**
 * This PHP function retrieves all movies directed by a specific director based on their ID.
 * 
 * Args:
 *   id (int): The `id` parameter in the `getMovieOfDirector` function is an integer that represents
 * the unique identifier of a director. This function retrieves all movies associated with the director
 * whose ID matches the provided `id` parameter.
 * 
 * Returns:
 *   The `getMovieOfDirector` function is returning an array of all movies that have a director with
 * the specified ID.
 */
    public function getMovieOfDirector(int $id){
        $request = $this->pdo->prepare("
            SELECT *
            FROM movie
            WHERE id_director = :id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `insertDirector` inserts a new director into the database along with their personal
 * information.
 * 
 * Args:
 *   data: It looks like the code you provided is a PHP function that inserts a director into a
 * database. The function takes an array `` as a parameter, which should contain the following
 * keys: 'firstname', 'name', 'birthday', and 'genre'.
 * 
 * Returns:
 *   This `insertDirector` function returns a boolean value. It returns `true` if the data insertion
 * into the `person` and `director` tables is successful, and it returns `false` if an exception is
 * caught during the process.
 */
    public function insertDirector($data):bool{
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
                    $requestDirectorInsert = $this->pdo->prepare("
                        INSERT INTO director(
                        id_person)
                        VALUES(
                        :id_person);
                    ");
                    $requestDirectorInsert->bindParam(':id_person',$idPerson);
                    if ($requestDirectorInsert->execute()) {
                        return true;
                    }else {
                        throw new Exception("Erreur lors de l'insertion des données dans la table 'director'");
                    }
                }else {
                    throw new Exception("Erreur lors de l'insertion des données dans la table 'person'");
                }
            }else{
                throw new Exception("Les données semble etre vide . . .");
            }
        } catch (\Exception $e) {
            $_SESSION['error']=$e;
            return false;
        }
    }

    public function getDirectorsSearch(string $content):array{
        $content = '%'.$content.'%';
        $request = $this->pdo->prepare("
            SELECT person.* , id_director
            FROM person,director
            Where person.id_person = director.id_person AND person.name LIKE :content;
        ");
        $request->bindParam(':content',$content);
        $request->execute();
        return $request->fetchAll();
    }

}