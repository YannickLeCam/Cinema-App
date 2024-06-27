<?php

namespace Controller;

use Model\MovieManager;

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


}