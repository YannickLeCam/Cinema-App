<?php
ob_start();
if (isset($_SESSION['movieData'])) {
    $data = $_SESSION['movieData'];
    unset($_SESSION['movieData']);
}
use Service\NavService;
$navService= new NavService();

echo $navService->navCreate();
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
    foreach ($listTypes as $key=>$type) {
        $typeName = $type['name'];
        $typeId = $type['id_type'];
        $htmlContent .= <<<HTML
        <input type="checkbox" class="btn-check" value=$typeId name=type[] id="btn-check-$key" autocomplete="off">
        <label class="btn" for="btn-check-$key">$typeName</label>
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
    $htmlContent = "<select name='id_director' id='directorSelect' class='form-select mb-3'>";
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
    <div class="form-floating mb-3">
        <input type="text" name="name" id="floatingInput" class="form-control" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>" placeholder="Entrer le titre du film :">
        <label for="floatingInput">Entrer le tire du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="date" id="floatingInput" name="date_release" class="form-control" value="<?=(isset($data['date_release']) ? $data['date_release'] :"")?>" placeholder="Date de sortie du film :">
        <label for="floatingInput">Date de sortie du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" name="duration" id="floatingInput" class="form-control" min=0 value="<?=(isset($data['duration']) ? $data['duration'] :"")?>" placeholder="Entrer la durée du film :">
        <label for="floatingInput">Entrer la durée du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="rate" id="floatingInput" class="form-control" value="<?=(isset($data['rate']) ? $data['rate'] :"")?>" placeholder="Evaluer le film (sur 10) :">
        <label for="floatingInput">Evaluer le film (sur 10) :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="url" name="posterURL" id="floatingInput" class="form-control" value="<?=(isset($data['posterURL']) ? $data['posterURL'] :"")?>" placeholder="Entrer l'affiche du film :">
        <label for="floatingInput">Entrer l'affiche du film :</label>    
    </div>

    <label for="type">Entrer le(s) genre(s) du film :</label>
    <?=createInputType($listTypes)?>

    <label for="director">Entrer le réalisateur :</label>
    <?=createSelectDirectors($listDirectors)?>

    <div class="form-floating">
        <textarea name="synopsis" id="floatingTextarea2" class="form-control" placeholder="Entrer le synopsis du film :" value="<?=(isset($data['synopsis']) ? $data['synopsis'] :"")?>"></textarea>
        <label for="floatingTextarea2">Entrer le synopsis du film :</label>
    </div>
 
    <input type="submit" name="SubmitMovieForm" class="btn btn-secondary" value="Ajouter">
</form>



<?php
$title = "Nouveau Film";
$titleText = "Nouveau Film";
$content = ob_get_clean();
require_once "view/template.php";
?>