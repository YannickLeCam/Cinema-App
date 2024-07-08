<?php ob_start();


use Service\NavService;
use Service\CardService;

$cardService=new CardService();
$navService=new NavService();
echo $navService->navList();
?>

<div id="listCardWithoutPicture">
    <div id="research">
        <form action="./index.php?action=listDirectors" method="post">
            <input type="text" name="nameContain" id="">
            <input type="submit" name="SubmitSearchButton" class="btn btn-secondary" value="Rechercher">
        </form>
    </div>
    <?=$cardService->createCardsDirectors($directors)?>
</div>




<?php
$title = "Liste des réalisateurs";
$titleText = "Liste des réalisateurs";
$content = ob_get_clean();
require_once "view/template.php";
?>