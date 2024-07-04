<?php ob_start();

$roleName=$role['name'];

use Service\CardService;

$cardService = new CardService();
?>

<div id="wrapperWithoutPicture">
    <h2>Filmography</h2>
    <?=$cardService->createListFilmographyRole($listCasting)?>
</div>





<?php
$title = $roleName;
$titleText = $roleName;
$content = ob_get_clean();
require_once "view/template.php";
?>