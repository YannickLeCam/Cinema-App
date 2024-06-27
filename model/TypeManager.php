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
        $request = $this->pdo->query("
            SELECT *
            FROM type
            WHERE id_type=:id;
        ");
        $request->bindParam(":id",$id);
        $request->execute();
        return $request->fetch();
    }


}