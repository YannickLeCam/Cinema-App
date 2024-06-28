<?php
ob_start();
if (isset($_SESSION['movieData'])) {
    $data = $_SESSION['movieData'];
    unset($_SESSION['movieData']);
}

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

function createInputDirector($listDirectors){
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
    <input type="number" name="duration" id="duration" min=0>
    <label for="rate">Evaluer le film (sur 10) :</label>
    <input type="text" name="rate" id="inputRate">
    <label for="poster">Entrer l'affiche du film :</label>
    <input type="url" name="posterURL" id="inputPoster">
    <label for="type">Entrer le(s) genre(s) du film :</label>
    <?=createInputType($listTypes)?>
    <label for="director">Entrer le réalisateur :</label>
    <?=createInputDirector($listDirectors)?>
    <label for="synopsis">Entrer le synopsis du film :</label>
    <textarea name="synopsis" id="synopsis"></textarea>
    <input type="submit" name="SubmitMovieForm" value="Ajouter">
</form>



<?php
$title = "Nouveau Film";
$titleText = "Nouveau Film";
$content = ob_get_clean();
require_once "view/template.php";
?>