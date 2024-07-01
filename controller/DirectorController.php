<?php

namespace Controller;

use DateTime;
use Model\DirectorManager;

class DirectorController {

/**
 * The `listDirectors` function retrieves a list of directors and displays them using a view template.
 */
    public function listDirectors(){
        $directorManager = new DirectorManager();
        $directors = $directorManager->getDirectors();
        
        require 'view/listDirectors.php';
    }

/**
 * The function `detailDirector` retrieves details of a director and their associated movies for
 * display in a view.
 * 
 * Args:
 *   id (int): The `detailDirector` function takes an integer parameter `` which represents the
 * unique identifier of a director. This function retrieves the details of the director with the
 * specified ID using the `DirectorManager` class. It then fetches a list of movies associated with
 * that director before rendering the details in the
 */
    public function detailDirector(int $id){
        $directorManager = new DirectorManager();
        $director = $directorManager->getDirectorDetail($id);
        $listMovies = $directorManager->getMovieOfDirector($id);

        require 'view/detailDirector.php';
    }

/**
 * The `newDirector` function in PHP creates a new director by processing form data, validating input,
 * and inserting the director into the database, handling success and error messages accordingly.
 */
    public function newDirector(){
        $directorManager = new DirectorManager();
        if (isset($_POST['SubmitDirectorForm'])) {
            $data=[];

            $firstname = filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_SPECIAL_CHARS);
            $name = filter_input(INPUT_POST,'name',FILTER_SANITIZE_SPECIAL_CHARS);
            $genre = filter_input(INPUT_POST,'genre',FILTER_SANITIZE_SPECIAL_CHARS);
            //GPT
            $birthday = filter_input(INPUT_POST, 'birthday', FILTER_VALIDATE_REGEXP, array(
                "options" => array("regexp" => '/^\d{4}-\d{2}-\d{2}$/')));
            $data['firstname']=$firstname;
            $data['name']=$name;
            $data['birthday']=$birthday;
            $data['genre']=$genre;

            if ($firstname!="" && $name != "" && $genre != "" && $birthday=!"") {
                if ($directorManager->insertDirector($data)) {
                    $_SESSION['success']="Le réalisateur a bien été enregistré";
                }else {
                    
                }
            }else {
                $_SESSION["error"]="Il semble manquer un atribut . . .";
                $_SESSION['dataDirector']=$data;
                header("Location:./index.php?createDirector");
                die();
            }
        }

        require 'view/createDirector.php';
    }


}


?>