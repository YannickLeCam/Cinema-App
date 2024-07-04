<?php ob_start();
$directorName = $director['name'].' '.$director['firstname'];
$birthday = new \DateTime($director['birthday']);
// Formate the date in french
$formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
$formattedBirthday = $formatter->format($birthday);
use Service\CardService;

$cardService = new CardService();
?>

<div id="wrapperWithoutPicture">
    <h2>Informations</h2>
    <p>Le <?=$director['genre']=='Female' ? "réalisatrice" : 'réalisateur'?> est né<?=$director['genre']=="Female" ? "e":""?> le <?=$formattedBirthday?>. </p>
    <?=!empty($listMovies) ? "<h2>Réalisation</h2>" : ""?>
    <?=$cardService->createListFilmographyDirector($listMovies,$director['genre'])?>
    <?=!empty($playedMovies) ? "<h2>Filmography</h2>" : ""?>
    <?=$cardService->createListFilmographyActor($playedMovies,$director['genre'])?>
</div>

<?php
$title = $directorName;
$titleText = $directorName;
$content = ob_get_clean();
require_once "view/template.php";
?>