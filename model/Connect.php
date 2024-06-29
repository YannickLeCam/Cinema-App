<?php

namespace Model;

abstract class Connect {

    const HOST = "localhost"; //DB IP
    const DB = "cinema-lecam"; //DB name
    const USER = "root"; //DB username
    const PASS = "";  // DB password

/**
 * The function `seConnecter` establishes a connection to a MySQL database using PDO in PHP.
 * 
 * Returns:
 *   If the connection to the database is successful, a new PDO object is being returned. If there is
 * an error during the connection attempt, the error message from the PDOException is being returned.
 */
    public static function seConnecter(){
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=UTF8", self::USER, self::PASS
            );
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}




?>