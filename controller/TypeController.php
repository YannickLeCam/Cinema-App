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


    
    public function newType(){
        $typeManager = new TypeManager();
        if (isset($_POST["SubmitTypeForm"])) {
            $data=[];
            
            $name = filter_input(INPUT_POST,"name", FILTER_SANITIZE_SPECIAL_CHARS);
            

            $listTypes = $typeManager->getTypes();
            foreach ($listTypes as $type) {
                if (in_array($name , $type)) {
                    $_SESSION["error"]="$name semble deja avoir été créé . . .";
                    header("Location:./index.php?action=createType"); // redirect to type form
                }
            }

            $data['name']=$name;

            if($typeManager->insertType($data)){
                $_SESSION["success"]="Le genre $name a bien été créé !";
            }else {
                if(!isset($_SESSION['error'])){
                    $_SESSION["error"]="L'ajout du genre $name a échoué . . .";
                }
                $_SESSION["typeData"] = $data;
            }
            header("Location:./index.php?action=createType"); // redirect to type form
        }
        
        require 'view/createType.php'; // form to create a new Type
    }
}

?>