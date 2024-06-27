<?php

namespace Model;

use Model\Connect;

class RoleManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

    public function getRoles():array{
        $request = $this->pdo->query("
            SELECT *
            FROM role
        ");
        $request->execute(); 
        return $request->fetchAll();
    }

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

    public function getActorMovieOfRole(int $id):array{
        $requestActor = $this->pdo -> prepare ("
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
        $requestActor->bindParam(":id",$id);
        $requestActor->execute();
        return $requestActor->fetchAll();
    }


}


?>