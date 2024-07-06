<?php

namespace Controller;

use Model\ActorManager;
use Model\DirectorManager;
use Model\MovieManager;
use Model\RoleManager;
use Model\TypeManager;

class MovieController {

    /**
 * The function `listFilm` retrieves all records from the `movie` table and then includes the
 * `listFilm.php` view file.
 */
    public function listMovies(){
        $movieManager = new MovieManager();
        if (isset($_POST['SubmitSearchButton'])) {
            $content = filter_input(INPUT_POST,'titleContain',FILTER_SANITIZE_SPECIAL_CHARS);
            $listMovies = $movieManager->getMoviesSearch($content);
        }else {
            $listMovies = $movieManager->getMovies();
        }
        
  
        require "view/list/listMovies.php";
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

        require "view/detail/detailMovie.php";
    }

    /**
     * The function `newMovie` handles the creation of a new movie by validating and processing form
     * data before inserting it into the database.
     */
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
            
            if (isset($_POST['type']) && is_array($_POST['type'])) {
                $data["types"] = filter_var($_POST['type'], FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
            } else {
                $data["types"] = [];
            }

            if (filter_input(INPUT_POST,'posterURL',FILTER_VALIDATE_URL)) {
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
                $this->errorCreate("Il semblerait y avoir une erreur sur la selection du réalisateur . . .",$data);
            }
            $typeChecked = false;
            foreach($data['types'] as $typeSelected){
                foreach ($listTypes as $type) {
                    if (in_array($typeSelected,$type)) {
                        $typeChecked=true;
                    }
                }
                if (!$typeChecked) {
                    die;
                    $this->errorCreate("Il semblerait y avoir une erreur sur le genre du film",$data);
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

        require 'view/create/createMovie.php';
    }

/**
 * The function `createCasting` in PHP handles the creation of a casting link by validating and
 * processing form data, checking for errors, and redirecting accordingly.
 */
    public function createCasting(){
        $movieManager=new MovieManager();
        $listMovies = $movieManager->getMovies();
        $roleManager=new RoleManager();
        $listRoles = $roleManager->getRoles();
        $actorManager = new ActorManager();
        $listActors = $actorManager->getActors();

        if (isset($_POST['SubmitCastingForm'])) {
            $data['role'] = filter_input(INPUT_POST,'role',FILTER_VALIDATE_INT);
            $data['movie'] = filter_input(INPUT_POST,'movie',FILTER_VALIDATE_INT);
            $data['actor'] = filter_input(INPUT_POST,'actor',FILTER_VALIDATE_INT);
            
            if (!$this->isInside($data['role'],$listRoles)) {
                $_SESSION["error"]="Il semble avoir un probleme avec la selection du role";
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=createCasting');
                die;
            }
            if (!$this->isInside($data['movie'],$listMovies)) {
                $_SESSION["error"]="Il semble avoir un probleme avec la selection du film";
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=createCasting');
                die;           
            }
            if (!$this->isInside($data['actor'],$listActors)) {
                $_SESSION["error"]="Il semble avoir un probleme avec la selection de l'acteur";
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=createCasting');
                die;
            }

            if($movieManager->insertLinkCasting($data)){
                $_SESSION["success"]="Lien a bien été créer";
                header('Location:./index.php?action=createCasting');
                die;
            }else {
                $_SESSION["error"]="Il semble avoir un probleme avec la selection de l'acteur";
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=createCasting');
                die;
            }
        }

        require 'view/create/createCasting.php';
    }

   /**
    * The function `isInside` checks if a given `` is present inside any sub-array of a
    * multidimensional array ``.
    * 
    * Args:
    *   id: The `id` parameter is the value that you are checking for inside the list. It is the value
    * that you want to determine if it exists within the elements of the list.
    *   list: The `` parameter in the `isInside` function is expected to be an array containing
    * elements that can be checked for the presence of a specific `` value. Each element in the
    * `` array is checked to see if it contains the `` value using the `in_array
    * 
    * Returns:
    *   The function `isInside` is returning a boolean value - `true` if the `` is found inside any
    * of the subarrays in the ``, and `false` if it is not found in any of the subarrays.
    */
    private function isInside($id,$list):bool{
        foreach ($list as $value) {
            if (in_array($id,$value)) {
                return true;
            }
        }
        return false;
    }


/**
 * The errorCreate function sets error message and movie data in session, then redirects to createMovie
 * action in index.php.
 * 
 * Args:
 *   message (string): The `message` parameter in the `errorCreate` function is a string that
 * represents the error message or description that will be stored in the session variable
 * `["error"]`.
 *   data (array): The `errorCreate` function takes two parameters:
 */
    private function errorCreate(string $message , array $data):void {
        $_SESSION["error"]=$message;
        $_SESSION["movieData"]=$data;
        header('Location:./index.php?action=createMovie');
        die;
    }

    private function verifyMovieData($data,$listDirectors,$listTypes){
        if ($data['name']=="") {
            $data["error"]="Il semble manquer le titre du film . . .";
            return $data;
        }
        if ($data["synopsis"]=="") {
            $data["error"]="Il semble manquer le synopsis du film . . .";
            return $data;
        }
        if ($data['rate']=="" || $data['rate']<0 ||$data['rate']>10) {
            $data["error"]="L'evaluation du film semble etre invalide . . .";
            return $data;
        }
        if ($data['duration']=="" || $data["duration"]<0 ||$data['duration']>1440) {
            $data["error"]="La durée du film semble etre invalide . . .";
            return $data;
        }
        if($data['date_release']==null || $data['date_release']==""){
            $data["error"]="La date de sortie du film semble etre invalide . . .";
            return $data;
        }
        $directorChecked = false;
        foreach ($listDirectors as $director) {
            if (in_array($data['id_director'],$director)) {
                $directorChecked = true;
            }
        }
        if (!$directorChecked) {
            $data["error"]="Il semblerait y avoir une erreur sur la selection du réalisateur . . .";
            return $data;
        }
        $typeChecked = false;
        foreach($data['types'] as $typeSelected){
            foreach ($listTypes as $type) {
                if (in_array($typeSelected,$type)) {
                    $typeChecked=true;
                }
            }
            if (!$typeChecked) {
                $data["error"]="Il semblerait y avoir une erreur sur la selection des types . . .";
                return $data;
            }
            $typeChecked=false;
        }

        return $data;
    }

/**
 * The function `editMovie` in PHP is responsible for editing movie details and updating them in the
 * database based on user input.
 * 
 * Args:
 *   id (int): The `editMovie` function you provided seems to handle the editing of movie details based
 * on the ID passed to it. It retrieves movie details, casting information, types, directors, actors,
 * and roles related to the movie with the given ID. It also handles form submissions for updating
 * movie information.
 */
    public function editMovie(int $id):void{
        var_dump($_POST);
        $movieManager=new MovieManager();
        $data['movie']=$movieManager->getMovieDetail($id);
        $data['casting']=$movieManager->getActorRoleOfMovie($id);
        $data['types']=$movieManager->getTypesOfMovie($id);
        $data['directors']=$movieManager->getDirectorOfMovie($id);
        $actorManager = new ActorManager();
        $listActors = $actorManager->getActors(); // pour le select
        $typeManager = new TypeManager();
        $listTypes = $typeManager->getTypes();
        $roleManager = new RoleManager();
        $listRoles = $roleManager->getRoles();
        $directorManager = new DirectorManager();
        $listDirectors = $directorManager->getDirectors();
        if (isset($_POST['submitEditMovie'])) {
            $data['movie']['name'] = filter_input(INPUT_POST,'name' , FILTER_SANITIZE_SPECIAL_CHARS);
            $data['movie']['date_release'] = filter_input(INPUT_POST, 'date_release', FILTER_VALIDATE_REGEXP, array(
                "options" => array("regexp" => '/^\d{4}-\d{2}-\d{2}$/')));
            $data['movie']['duration'] = filter_input(INPUT_POST,'duration',FILTER_VALIDATE_INT);
            $data['movie']['synopsis'] = filter_input(INPUT_POST,'synopsis',FILTER_SANITIZE_SPECIAL_CHARS);
            $data['movie']['rate'] = filter_input(INPUT_POST , 'rate' , FILTER_VALIDATE_FLOAT);
            $data['movie']['id_director'] = filter_input(INPUT_POST,'id_director',FILTER_VALIDATE_INT);
            if (isset($_POST['type']) && is_array($_POST['type'])) {
                $data['movie']["types"] = filter_var($_POST['type'], FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
            } else {
                $data['movie']["types"] = [];
            }
            if (filter_input(INPUT_POST,'posterURL',FILTER_VALIDATE_URL)) {
                $data['movie']['poster'] = filter_input(INPUT_POST,'posterURL',FILTER_SANITIZE_URL);
            }else {
                $data['movie']["poster"] = "";
            }
            $data['movie']=$this->verifyMovieData($data['movie'],$listDirectors,$listTypes);
            if (isset($data['error'])) {
                $_SESSION["error"]=$data['error'];
                $_SESSION["movieData"]=$data;
                header('Location:./index.php?action=editMovie&id='.$id);
                die;
            }
            $movieManager->updateMovie($id,$data['movie']);
            header('Location:./index.php?action=editMovie&id='.$id);
            die;
            // donnée movie sont saint ! on peut les update comme ca !
            //TO DO rendre le casting saint avec filter var

        }

        require 'view/edit/editMovie.php';
    }
}