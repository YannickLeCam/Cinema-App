<?php

namespace Model;

abstract class Connect {

    const HOST = "localhost"; //DB IP
    const DB = "cinema-lecam"; //DB name
    const USER = "root"; //DB username
    const PASS = "";  // DB password

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