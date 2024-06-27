<?php

namespace Model;

use Model\Connect;

class MovieManager{
    private \PDO $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

    public function getMovies():array{
        $request = $this->pdo->query("
            SELECT *
            FROM movie;
        ");
        $request->execute();
        return $request->fetchAll();
    }

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

    public function getActorRoleOfMovie(int $id){
        $requestCasting = $this->pdo->prepare("
            SELECT role.name , CONCAT(person.name,' ',person.firstname) AS Actor
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

}