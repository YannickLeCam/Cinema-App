<?php 


namespace Service;

class CardService {
    public function createCardsActors($listActors):string{
        $htmlContent ="";
        foreach ($listActors as $actor) {
            $birthday = new \DateTime($actor['birthday']);
            
            // Formatter la date en français
            $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
            $formattedBirthday = $formatter->format($birthday);
            if ($actor['genre']=="Female") {
                $ne= "Née";
            }
            else {
                $ne="Né";
            }
            $htmlContent .= '<a href="./index.php?action=detailActor&id='.$actor['id_actor'].'"><div class="Card"><h4>'.$actor['name'].' '.$actor['firstname'].'</h4><p>'.$ne.' le '. $formattedBirthday.'</p></div></a>';
        }
    
        return $htmlContent;
    }

    public function createCardsDirectors($listDirectors):string{
        $htmlContent ="";
        foreach ($listDirectors as $director) {
            $birthday = new \DateTime($director['birthday']);
            
            // Formatter la date en français
            $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
            $formattedBirthday = $formatter->format($birthday);
            if ($director['genre']=="Female") {
                $ne= "Née";
            }
            else {
                $ne="Né";
            }
            $htmlContent .= '<a href="./index.php?action=detailDirector&id='.$director['id_director'].'"><div class="Card"><h4>'.$director['name'].' '.$director['firstname'].'</h4><p>'.$ne.' le '. $formattedBirthday.'</p></div></a>';
        }
    
        return $htmlContent;
    }

    public function createCardsMovies (array $listMovies):string{
        $htmlContent= "";
        foreach ($listMovies as $movie) {
            $htmlContent .= '<a href="./index.php?action=detailMovie&id='.$movie['id_movie'].'">';
            $htmlContent .= '<div class="Card"> <div class="CardHeader"><img src="'.$movie['poster'].'" alt=""></div> <h4>'.$movie['name'].'</h4>  <p>'.$movie['rate'].'</p> </div> ';
            $htmlContent .= '</a>';
        }
        return $htmlContent;
    }

    public function createCardsRoles($listRoles){
        $htmlContent ="";
        foreach ($listRoles as $role) {
            $htmlContent .= '<a href="./index.php?action=detailRole&id='.$role['id_role'].'"><div class="Card"><h4>'.$role['name'].'</h4></div></a>';
        }
        return $htmlContent;
    }
    
    public function createCardsTypes($listTypes){
        $htmlContent ="";
        foreach ($listTypes as $type) {
            $htmlContent .= '<a href="./index.php?action=detailType&id='.$type['id_type'].'"><div class="Card"><h4>'.$type['name'].'</h4></div></a>';
        }
        return $htmlContent;
    }
}