<?php ob_start();

function createCardsTypes($listTypes){
    $htmlContent ="";
    foreach ($listTypes as $type) {
        $htmlContent .= '<a href="./index.php?action=detailType&id='.$type['id_type'].'"><div class="card"><h4>'.$type['name'].'</h4></div></a>';
    }
    return $htmlContent;
}

use Service\NavService;

$navService=new NavService();
echo $navService->navList();
?>


<div id="listCardWithoutPicture">
    <div id="research">
        <form action="./index.php?action=listActors" method="post">
            <input type="text" name="titleContain" id="">
            <input type="submit" name="SubmitSearchButton" value="Rechercher">
        </form>
    </div>
    <?=createCardsTypes($listTypes)?>
</div>





<?php
$title = "Liste des genres de films";
$titleText = "Liste des genres de films";
$content = ob_get_clean();
require_once "view/template.php";
?>