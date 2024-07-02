<?php ob_start();


function createCardsTypes($listRoles){
    $htmlContent ="";
    foreach ($listRoles as $role) {
        $htmlContent .= '<a href="./index.php?action=detailRole&id='.$role['id_role'].'"><div class="card"><h4>'.$role['name'].'</h4></div></a>';
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
    <?=createCardsTypes($listRoles)?>
</div>


<?php
$title = "Liste des Roles";
$titleText = "Liste des Roles";
$content = ob_get_clean();
require_once "view/template.php";
?>