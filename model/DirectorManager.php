<?php

namespace Model;

use Model\Connect;

class DirectorManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

    public function getDirectors():array{
        $request = $this->pdo->query("
            SELECT person.* , id_director
            FROM person,director
            Where person.id_person = director.id_person;
        ");
        $request->execute();
        return $request->fetchAll();
    }

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

}