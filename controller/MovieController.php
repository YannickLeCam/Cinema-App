<?php

namespace Controller;

use Model\DirectorManager;
use Model\MovieManager;
use Model\TypeManager;

class MovieController {

    /**
 * The function `listFilm` retrieves all records from the `movie` table and then includes the
 * `listFilm.php` view file.
 */
    public function listMovies(){
        $movieManager = new MovieManager();
        $listMovies = $movieManager->getMovies();

        require "view/listMovies.php";
    }

    /**
 * The function detailMovie retrieves information about a specific movie and its casting details from a
 * database using PHP and PDO.
 * 
 * @param int id_movie The code you provided seems to have a couple of errors. Here are the
 * corrections:
 */
    public function detailMovie(int $id_movie){
        $movieManager = new MovieManager();
        $movie = $movieManager->getMovieDetail($id_movie);
        $listCasting = $movieManager->getActorRoleOfMovie($id_movie);
        $listTypes = $movieManager->getTypesOfMovie($id_movie);
        $director = $movieManager->getDirectorOfMovie($id_movie);

        require "view/detailMovie.php";
    }

    public function newMovie(){
        $directorManager= new DirectorManager();
        $typeManager = new TypeManager();
        $movieManager = new MovieManager();
        $listDirectors = $directorManager->getDirectors();
        $listTypes = $typeManager->getTypes();

        if (isset($_POST['SubmitMovieForm'])) {

            $data=[];
            $data['name'] = filter_input(INPUT_POST,'name' , FILTER_SANITIZE_SPECIAL_CHARS);
            $data['date_release'] = filter_input(INPUT_POST, 'date_release', FILTER_VALIDATE_REGEXP, array(
                "options" => array("regexp" => '/^\d{4}-\d{2}-\d{2}$/')));
            $data['duration'] = filter_input(INPUT_POST,'duration',FILTER_VALIDATE_INT);
            $data['synopsis'] = filter_input(INPUT_POST,'synopsis',FILTER_SANITIZE_SPECIAL_CHARS);
            $data['rate'] = filter_input(INPUT_POST , 'rate' , FILTER_VALIDATE_FLOAT);
            $data['id_director'] = filter_input(INPUT_POST,'id_director',FILTER_VALIDATE_INT);
            $args = [
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_FORCE_ARRAY
            ];
            $data["types"]=filter_var_array($_POST['type'], $args);
            if (filter_input(INPUT_POST,'posterURl',FILTER_VALIDATE_URL)) {
                $data['poster'] = filter_input(INPUT_POST,'posterURL',FILTER_SANITIZE_URL);
            }else {
                $data["poster"] = "";
            }

            if ($data['name']=="") {
                $this->errorCreate("Il semble manquer le titre du film . . ." ,$data);
            }
            if ($data["synopsis"]=="") {
                $this->errorCreate("Il semble manquer le synopsis du film . . ." ,$data);
            }
            if ($data['rate']=="" || $data['rate']<0 ||$data['rate']>10) {
                $this->errorCreate("L'evaluation du film semble etre invalide . . .",$data);
            }
            if ($data['duration']=="" || $data["duration"]<0 ||$data['duration']>1440) {
                $this->errorCreate("La durée du film semble etre invalide . . .",$data);
            }
            if($data['date_release']==null || $data['date_release']==""){
                $this->errorCreate("La date de dortie du film semble etre invalide . . .",$data);
            }
            $directorChecked = false;
            foreach ($listDirectors as $director) {
                if (in_array($data['id_director'],$director)) {
                    $directorChecked = true;
                }
            }
            if (!$directorChecked) {
                $this->errorCreate("Il semblerait y avoir une erreure sur la selection du réalisateur . . .",$data);
            }
            $typeChecked = false;
            foreach($data['type'] as $typeSelected){
                foreach ($listTypes as $type) {
                    if (in_array($typeSelected,$type)) {
                        $typeChecked=true;
                    }
                }
                if (!$typeChecked) {
                    $this->errorCreate("Il semblerait y avoir une erreure sur le genre du film",$data);
                }
                $typeChecked=false;
            }

            if($movieManager->insertMovie($data)){
                $_SESSION["success"]="Le film a bien été ajouté !";
                header('Location:./index.php?action=createMovie');
                die;
            }else {
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=createMovie');
                die;
            }
        }

        require 'view/createMovie.php';
    }

    private function errorCreate(string $message , array $data):void {
        $_SESSION["error"]=$message;
        $_SESSION["movieData"]=$data;
        header('Location:./index.php?action=createMovie');
        die;
    }

}