<?php

namespace Model;

use Model\Connect;

class TypeManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

/**
 * This PHP function retrieves all types from a database table named "type" using PDO and returns them
 * as an array.
 * 
 * Returns:
 *   An array of all the rows from the "type" table in the database is being returned.
 */
    public function getTypes():array{
        $request = $this->pdo->query("
            SELECT *
            FROM type;
        ");
        $request->execute();
        return $request->fetchAll();
    }

/**
 * This PHP function retrieves details of a specific type based on its ID from a database table.
 * 
 * Args:
 *   id (int): The `getTypeDetail` function takes an integer parameter `` which represents the id of
 * the type you want to retrieve details for from the database. The function then prepares and executes
 * a SQL query to fetch the details of the type with the specified id from the `type` table in the
 * database.
 * 
 * Returns:
 *   The function `getTypeDetail` is returning the details of a specific type based on the provided
 * ``. It prepares and executes a SQL query to select all columns from the `type` table where the
 * `id_type` matches the provided ``. The function then fetches and returns the result of the query,
 * which is a single row representing the details of the type with the specified ID.
 */
    public function getTypeDetail(int $id){
        $request = $this->pdo->prepare("
            SELECT *
            FROM type
            WHERE id_type=:id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetch();
    }

/**
 * This PHP function retrieves movies of a specific type from a database using prepared statements.
 * 
 * Args:
 *   id (int): The `getFilmOfType` function takes an integer parameter `` which represents the id of
 * a film type. The function retrieves all movies that belong to the specified film type identified by
 * the given ``.
 * 
 * Returns:
 *   The `getFilmOfType` function is returning an array of movie records that belong to a specific type
 * identified by the provided ``. The function executes a SQL query to fetch movie records based on
 * the type ID provided as a parameter.
 */
    public function getFilmOfType(int $id){
        $request = $this->pdo->prepare("
            SELECT movie.*
            FROM type
            JOIN be
            ON be.id_type = type.id_type
            JOIN movie
            ON movie.id_movie = be.id_movie
            WHERE be.id_type = :id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetchAll();
    }

/**
 * The function `insertType` inserts a new record into the `type` table with the provided name value in
 * PHP using PDO.
 * 
 * Args:
 *   data (array): The `insertType` function takes an array `` as a parameter. The function checks
 * if the key 'name' exists in the `` array. If it does, the function prepares an SQL query to
 * insert a new record into the 'type' table with the value of 'name
 * 
 * Returns:
 *   The `insertType` function returns a boolean value. It returns `true` if the data insertion is
 * successful, `false` if the insertion fails or an exception is caught, and `false` if the 'name' key
 * is not set in the input data array.
 */
    public function insertType(array $data):bool{

        if (isset($data['name'])) {
            try {
                $request = $this->pdo->prepare("
                    INSERT INTO type (name)
                    VALUES (:name);
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
        
        return false;
    }
    public function getTypesSearch(string $content):array{
        $content = '%' . $content . '%';
        $request = $this->pdo->prepare("
            SELECT *
            FROM type
            WHERE name LIKE :content;
        ");
        $request->bindParam(':content',$content);
        $request->execute();
        return $request->fetchAll();
    }

}