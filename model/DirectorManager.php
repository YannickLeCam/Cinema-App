<?php

namespace Model;

use Exception;
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

}