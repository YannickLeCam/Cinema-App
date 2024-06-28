<?php

namespace Controller;

use DateTime;
use Model\DirectorManager;

class DirectorController {

    public function listDirectors(){
        $directorManager = new DirectorManager();
        $directors = $directorManager->getDirectors();
        
        require 'view/listDirector.php';
    }

    public function detailDirector(int $id){
        $directorManager = new DirectorManager();
        $director = $directorManager->getDirectorDetail($id);
        $listMovies = $directorManager->getMovieOfDirector($id);

        require 'view/detailDirector.php';
    }

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