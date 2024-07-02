<?php ob_start();



use Service\NavService;
use Service\CardService;

$cardService=new CardService();
$navService=new NavService();
echo $navService->navList();
?>

<div id="listCardWithoutPicture">
    <div id="research">
        <form action="./index.php?action=listActors" method="post">
            <input type="text" name="nameContain" id="">
            <input type="submit" name="SubmitSearchButton" value="Rechercher">
        </form>
    </div>
    <?=$cardService->createCardsActors($listActors)?>
</div>


<pre>
    <?=var_dump($listActors)?>
</pre>







<?php
$title = "Liste des Acteurs";
$titleText = "Liste des Acteurs";
$content = ob_get_clean();
require_once "view/template.php";
?>