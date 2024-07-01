<?php
ob_start();
if (isset($_SESSION['movieData'])) {
    $data = $_SESSION['movieData'];
    unset($_SESSION['movieData']);
}

/**
 * The function `createInputType` generates HTML checkboxes based on a list of types provided.
 * 
 * Args:
 *   listTypes: An array containing information about different types. Each element in the array should
 * have 'name' and 'id_type' keys to represent the type name and type ID respectively.
 * 
 * Returns:
 *   The function `createInputType` returns a HTML content string that contains a series of checkboxes
 * with labels based on the input list of types. Each checkbox corresponds to a type in the list, with
 * the type name as the label and the type ID as the value.
 */
function createInputType($listTypes){
    $htmlContent = "<div id='typeCheckbox'>";
    foreach ($listTypes as $type) {
        $typeName = $type['name'];
        $typeId = $type['id_type'];
        $htmlContent .= <<<HTML
        <input type="checkbox" value=$typeId name=type[] id="typeCheckBox">
        <label for="typeCheckBox">$typeName</label>
HTML;
    }
    $htmlContent .= "</div>";
    return $htmlContent;
}

/**
 * The function `createSelectDirectors` generates a dropdown select menu with director names and IDs
 * from a given list of directors.
 * 
 * Args:
 *   listDirectors:  is an array containing information about directors. Each element in
 * the array is an associative array with keys like 'name', 'firstname', and 'id_director' to store the
 * respective details of a director.
 * 
 * Returns:
 *   The function `createSelectDirectors` returns an HTML select element populated with options for
 * each director in the provided list. Each option includes the director's full name and their
 * corresponding ID.
 */
function createSelectDirectors($listDirectors){
    $htmlContent = "<select name='id_director' id='directorSelect'>";
    foreach ($listDirectors as $director) {
        $directorName = $director['name'].' '.$director['firstname'];
        $directorId = $director['id_director'];
        $htmlContent.= <<<HTML
            <option value=$directorId>$directorName</option>
HTML;
    }
    $htmlContent .= "</select>";
    return $htmlContent;
}
?>

<form action="./index.php?action=createMovie" method="post">
    <label for="name">Entrer le tire du film :</label>
    <input type="text" name="name" id="" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>">
    <label for="date_release">Date de sortie du film :</label>
    <input type="date" id="date_release" name="date_release" value="<?=(isset($data['date_release']) ? $data['date_release'] :"")?>">
    <label for="duration">Entrer la durée du film :</label>
    <input type="number" name="duration" id="duration" min=0 value="<?=(isset($data['duration']) ? $data['duration'] :"")?>">
    <label for="rate">Evaluer le film (sur 10) :</label>
    <input type="text" name="rate" id="inputRate" value="<?=(isset($data['rate']) ? $data['rate'] :"")?>">
    <label for="poster">Entrer l'affiche du film :</label>
    <input type="url" name="posterURL" id="inputPoster" value="<?=(isset($data['posterURL']) ? $data['posterURL'] :"")?>">
    <label for="type">Entrer le(s) genre(s) du film :</label>
    <?=createInputType($listTypes)?>
    <label for="director">Entrer le réalisateur :</label>
    <?=createSelectDirectors($listDirectors)?>
    <label for="synopsis">Entrer le synopsis du film :</label>
    <textarea name="synopsis" id="synopsis" value="<?=(isset($data['synopsis']) ? $data['synopsis'] :"")?>"></textarea>
    <input type="submit" name="SubmitMovieForm" value="Ajouter">
</form>



<?php
$title = "Nouveau Film";
$titleText = "Nouveau Film";
$content = ob_get_clean();
require_once "view/template.php";
?>