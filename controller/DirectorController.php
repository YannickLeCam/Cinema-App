<?php

namespace Controller;

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


}


?>