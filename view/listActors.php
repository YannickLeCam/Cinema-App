<?php ob_start();

function createCardsActors($listActors):string{
    $htmlContent ="";
    foreach ($listActors as $actor) {
        $birthday = new DateTime($actor['birthday']);
        
        // Formatter la date en français
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        $formattedBirthday = $formatter->format($birthday);
        if ($actor['genre']=="Female") {
            $ne= "Née";
        }
        else {
            $ne="Né";
        }
        $htmlContent .= '<a href="./index.php?action=detailActor&id='.$actor['id_actor'].'"><div class="card"><h4>'.$actor['name'].' '.$actor['firstname'].'</h4><p>'.$ne.' le '. $formattedBirthday.'</p></div></a>';
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
    <?=createCardsActors($listActors)?>
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