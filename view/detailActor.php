<?php ob_start();

$actorName = $actor['name'].' '.$actor['firstname'];
$birthday = new \DateTime($actor['birthday']);
// Formate the date in french
$formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
$formattedBirthday = $formatter->format($birthday);
use Service\CardService;

$cardService = new CardService();
?>

<h2>Informations</h2>
<p>L'<?=$actor['genre']=='Female' ? "actrice" : 'acteur'?> est né<?=$actor['genre']=="Female" ? "e":""?> le <?=$formattedBirthday?>. </p>
<h2>Filmography</h2>
<?=$cardService->createListFilmographyActor($filmography,$actor['genre'])?>






<?php
$title = $actorName;
$titleText = $actorName;
$content = ob_get_clean();
require_once "view/template.php";
?>