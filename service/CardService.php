<?php 


namespace Service;

class CardService {
/**
 * The function `createCardsActors` generates HTML content for displaying actor cards with their names,
 * birthdays, and gender information in French.
 * 
 * Args:
 *   listActors: The `createCardsActors` function takes a list of actors as input and generates HTML
 * content for displaying actor cards. Each actor card includes the actor's name, birthday formatted in
 * French, and a link to view more details about the actor.
 * 
 * Returns:
 *   The `createCardsActors` function returns a string containing HTML content for creating actor
 * cards. Each card includes the actor's name, birthday formatted in French, and a link to view more
 * details about the actor.
 */
    public function createCardsActors($listActors):string{
        $htmlContent ="";
        foreach ($listActors as $actor) {
            $birthday = new \DateTime($actor['birthday']);
            
            // Formate the date in french
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

/**
 * The function `createCardsDirectors` generates HTML cards for a list of directors with their names,
 * birthdays, and links to detailed information.
 * 
 * Args:
 *   listDirectors: The `createCardsDirectors` function you provided seems to generate HTML content for
 * displaying a list of directors. It formats the director's birthday in French and includes a link to
 * view more details about each director.
 * 
 * Returns:
 *   The `createCardsDirectors` function returns a string containing HTML content for creating cards
 * for a list of directors. Each card includes the director's name, first name, gender-specific "Né" or
 * "Née" (Born), and formatted birthday date in French. The HTML content is structured with a link to a
 * detail page for each director.
 */
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

/**
 * The function `createCardsMovies` generates HTML content for displaying a list of movies as cards
 * with details like name, poster, and rating.
 * 
 * Args:
 *   listMovies (array): The `createCardsMovies` function takes an array of movies as input and
 * generates HTML content for displaying these movies as cards with their poster, name, and rating.
 * 
 * Returns:
 *   The `createCardsMovies` function returns a string containing HTML content for displaying a list of
 * movies as cards. Each movie in the input array is represented as a card with its poster, name, and
 * rate, wrapped in an anchor tag linking to a detail page for that movie.
 */
    public function createCardsMovies (array $listMovies):string{
        $htmlContent= "";
        foreach ($listMovies as $movie) {
            $htmlContent .= '<a href="./index.php?action=detailMovie&id='.$movie['id_movie'].'">';
            $htmlContent .= '<div class="Card"> <div class="CardHeader"><img src="'.$movie['poster'].'" alt=""></div> <h4>'.$movie['name'].'</h4>  <p>'.$movie['rate'].'</p> </div> ';
            $htmlContent .= '</a>';
        }
        return $htmlContent;
    }

/**
 * The function `createCardsRoles` generates HTML content for displaying a list of roles with links to
 * their details.
 * 
 * Args:
 *   listRoles: An array containing information about different roles. Each role in the array should
 * have an 'id_role' key and a 'name' key.
 * 
 * Returns:
 *   The `createCardsRoles` function returns a string containing HTML code for creating cards with role
 * information. Each card includes a link to view more details about the role, with the role name
 * displayed as the card title.
 */
    public function createCardsRoles($listRoles){
        $htmlContent ="";
        foreach ($listRoles as $role) {
            $htmlContent .= '<a href="./index.php?action=detailRole&id='.$role['id_role'].'"><div class="Card"><h4>'.$role['name'].'</h4></div></a>';
        }
        return $htmlContent;
    }

/**
 * The function `createCardsTypes` generates HTML content for displaying a list of card types with
 * links to their detail pages.
 * 
 * Args:
 *   listTypes: An array containing information about different types of cards. Each element in the
 * array is an associative array with keys like 'id_type' and 'name' to represent the unique identifier
 * and name of the card type, respectively.
 * 
 * Returns:
 *   The `createCardsTypes` function returns a string containing HTML code for creating cards based on
 * the types provided in the `` array. Each card includes a link to a detail page for the
 * specific type, displaying the type's name within the card.
 */
    public function createCardsTypes($listTypes){
        $htmlContent ="";
        foreach ($listTypes as $type) {
            $htmlContent .= '<a href="./index.php?action=detailType&id='.$type['id_type'].'"><div class="Card"><h4>'.$type['name'].'</h4></div></a>';
        }
        return $htmlContent;
    }

    public function createListFilmographyRole (array $listCasting):string{
        $htmlContent='<ul>';
        foreach ($listCasting as $key => $casting) {
            $actorName=$casting['actorName'] . ' ' . $casting['firstname'];
            $htmlContent.='<div class="card"><li>';
            if ($casting['genre']=='female') {
                $htmlContent.='L\'actrice ';
            }else {
                $htmlContent.='L\'acteur ';
            }
            $htmlContent.= '<a href="./index.php?action=detailActor&id='.$casting['id_actor'].'">'.$actorName.'</a>' . ' a incarné le role dans le film <a href="./index.php?action=detailMovie&id='.$casting['id_movie'].'">'.$casting['movieName'].'</a> </li>' ;
            $htmlContent.='</div>';
        }
        $htmlContent.='</ul>';
        return $htmlContent;
    }

    public function createListFilmographyActor (array $listCasting,$genre){
        $htmlContent='<ul>';
        foreach ($listCasting as $key => $casting) {
            if ($genre == 'Female') {
                $incarne = "incarnée";
            }else {
                $incarne = "incarné";
            }
            $htmlContent.='<div class="card"><li>';
            $htmlContent.= 'A '.$incarne.' le role '.'<a href="./index.php?action=detailRole&id='.$casting['id_role'].'">'.$casting['roleName'].'</a> dans le film <a href="./index.php?action=detailMovie&id='.$casting['id_movie'].'">'.$casting['movieName'].'</a> </li>' ;
            $htmlContent.='</div>';
        }
        $htmlContent.='</ul>';
        return $htmlContent;
    }
}

