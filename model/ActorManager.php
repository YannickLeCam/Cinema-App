<?php

namespace Model;

use Model\Connect;

class ActorManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

    public function getActors():array{
        $request = $this->pdo->query("
            SELECT person.* , id_actor
            FROM person,actor
            Where person.id_person = actor.id_person;
        ");
        $request->execute();
        return $request->fetchAll();
    }

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


}