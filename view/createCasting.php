<?php
ob_start();
if (isset($_SESSION['movieData'])) {
    $data = $_SESSION['movieData'];
    unset($_SESSION['movieData']);
}


/**
 * The function `createSelectActors` generates a dropdown select menu with options based on a list of
 * actors.
 * 
 * Args:
 *   listActors:  is an array containing information about actors. Each element in the array
 * is an associative array with keys 'name', 'firstname', and 'id_director'. The function
 * createSelectActors takes this array as input and generates a dropdown select list in HTML format
 * with options for each actor's
 * 
 * Returns:
 *   The function `createSelectActors` returns an HTML select element populated with options for each
 * actor in the provided list. Each option includes the actor's full name (concatenation of 'name' and
 * 'firstname' fields) as the display text and the actor's ID as the option value.
 */
function createSelectActors($listActors){
    $htmlContent = "<select name='actor' id='directorSelect'>";
    foreach ($listActors as $key => $actor) {
        $actorName = $actor['name'].' '.$actor['firstname'];
        $actorId = $actor['id_actor'];
        if ($key=0) {
            $complement="selected";
        }else {
            $complement="";
        }
        $htmlContent.= <<<HTML
            <option value="$actorId" $complement>$actorName</option>
HTML;
    }
    $htmlContent .= "</select>";
    return $htmlContent;
}

/**
 * The function `createSelectMovies` generates a dropdown select menu with movie options based on a
 * given list of movies.
 * 
 * Args:
 *   listMovies: An array containing information about movies, where each element is an associative
 * array with keys 'name' and 'id_movie'.
 * 
 * Returns:
 *   The function `createSelectMovies` returns a HTML select element with options for each movie in the
 * provided list of movies. Each option has a value attribute set to the movie's ID and displays the
 * movie's name as the option text.
 */
function createSelectMovies($listMovies){
    $htmlContent = "<select name='movie' id='directorSelect'>";
    foreach ($listMovies as $movie) {
        $movieName = $movie['name'];
        $movieId = $movie['id_movie'];
        if ($key=0) {
            $complement="selected";
        }else {
            $complement="";
        }
        $htmlContent.= <<<HTML
            <option value="$movieId" $complement>$movieName</option>
HTML;
    }
    $htmlContent .= "</select>";
    return $htmlContent;
}


/**
 * The function `createSelectRoles` generates a HTML select element with options based on a list of
 * roles provided.
 * 
 * Args:
 *   listRoles (array): An array containing roles with 'name' and 'id_role' keys.
 * 
 * Returns:
 *   The function `createSelectRoles` returns a string containing an HTML `<select>` element with
 * options generated from the provided array of roles.
 */
function createSelectRoles(array $listRoles):string{
    $htmlContent = "<select name='role' id='directorSelect'>";
    foreach ($listRoles as $role) {
        $roleName = $role['name'];
        $roleId = $role['id_role'];
        if ($key=0) {
            $complement="selected";
        }else {
            $complement="";
        }
        $htmlContent.= <<<HTML
            <option value="$roleId" $complement>$roleName</option>
HTML;
    }
    $htmlContent .= "</select>";
    return $htmlContent;
}

use Service\NavService;
$navService= new NavService();

echo $navService->navCreate();
?>
<form action="./index.php?action=createCasting" method="post">
    <label for="movie">Selectionner le film :</label>
    <?=createSelectMovies($listMovies)?>
    <label for="role">Selectionner le role :</label>
    <?=createSelectRoles($listRoles)?>
    <label for="actor">Selectionner l'acteur :</label>
    <?=createSelectActors($listActors)?>
    <input type="submit" name="SubmitCastingForm" value="Ajouter le lien">
</form>

<?php
$title = "Nouveau Casting";
$titleText = "Nouveau Casting";
$content = ob_get_clean();
require_once "view/template.php";
?>