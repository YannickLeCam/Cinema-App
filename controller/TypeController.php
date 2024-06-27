<?php

namespace Controller;

use Model\TypeManager;

class TypeController {
    public function listTypes(){
        $typeManager = new TypeManager();
        $listTypes = $typeManager->getTypes();
        
        require "view/listTypes.php";
    }

    public function detailType(int $id){
        $typeManager = new TypeManager();
        $type = $typeManager->getTypeDetail($id);
        $listMovies = $typeManager->getFilmOfType($id);

        require 'view/detailType.php';
    }
}

?>