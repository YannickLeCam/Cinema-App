<?php ob_start();

$actorName = $actor['name'].' '.$actor['firstname'];
$birthday = new \DateTime($actor['birthday']);
// Formate the date in french
$formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
$formattedBirthday = $formatter->format($birthday);
use Service\CardService;

$cardService = new CardService();
?>
<div id="wrapperWithoutPicture">
    <h2>Informations</h2>
    <p>L'<?=$actor['genre']=='Female' ? "actrice" : 'acteur'?> est né<?=$actor['genre']=="Female" ? "e":""?> le <?=$formattedBirthday?>. </p>
    <?=!empty($filmography) ? "<h2>Filmography</h2>" : ""?>
    <?=$cardService->createListFilmographyActor($filmography,$actor['genre'])?>
    <?=(!empty($productMovies)) ? "<h2>Réalisation</h2>" : ""?> 
    <?=$cardService->createListFilmographyDirector($productMovies,$actor['genre']);?>
</div>




<?php
$title = $actorName;
$titleText = $actorName;
$content = ob_get_clean();
require_once "view/template.php";
?>