<?php

namespace Controller;

use Model\TypeManager;

class TypeController {

/**
 * The listTypes function retrieves a list of types using TypeManager and then includes a view file to
 * display the list.
 */
    public function listTypes(){
        $typeManager = new TypeManager();
        if (isset($_POST['SubmitSearchButton'])) {
            $content = filter_input(INPUT_POST,'nameContain',FILTER_SANITIZE_SPECIAL_CHARS);
            $listTypes = $typeManager->getTypesSearch($content);
        }else {
            $listTypes = $typeManager->getTypes();
        }
        
        
        require "view/list/listTypes.php";
    }

/**
 * The function `detailType` retrieves details and a list of movies for a specific type using a
 * TypeManager object and then loads a view file to display the information.
 * 
 * Args:
 *   id (int): The `detailType` function takes an integer parameter `` which represents the
 * identifier of a specific type. This function retrieves the details of the type with the given ``
 * using the `getTypeDetail` method of the `TypeManager` class. It also fetches a list of movies
 * associated
 */
    public function detailType(int $id){
        $typeManager = new TypeManager();
        $type = $typeManager->getTypeDetail($id);
        $listMovies = $typeManager->getFilmOfType($id);

        require 'view/detail/detailType.php';
    }


    
/**
 * This PHP function creates a new type by processing form data, checking for existing types, inserting
 * the new type into the database, and redirecting to the type creation form with success or error
 * messages.
 */
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
                    die;
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
            die;
        }
        
        require 'view/create/createType.php'; // form to create a new Type
    }
}

?>