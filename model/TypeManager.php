<?php

namespace Model;

use Model\Connect;

class TypeManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

    public function getTypes():array{
        $request = $this->pdo->query("
            SELECT *
            FROM type;
        ");
        $request->execute();
        return $request->fetchAll();
    }

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


}