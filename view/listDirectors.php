<?php ob_start();


function createCardsDirectors($listDirectors):string{
    $htmlContent ="";
    foreach ($listDirectors as $director) {
        $birthday = new DateTime($director['birthday']);
        
        // Formatter la date en français
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        $formattedBirthday = $formatter->format($birthday);
        if ($director['genre']=="Female") {
            $ne= "Née";
        }
        else {
            $ne="Né";
        }
        $htmlContent .= '<a href="./index.php?action=detailActor&id='.$director['id_director'].'"><div class="card"><h4>'.$director['name'].' '.$director['firstname'].'</h4><p>'.$ne.' le '. $formattedBirthday.'</p></div></a>';
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
    <?=createCardsDirectors($directors)?>
</div>

<pre>
    <?=var_dump($directors)?>
</pre>







<?php
$title = "Liste des réalisateurs";
$titleText = "Liste des réalisateurs";
$content = ob_get_clean();
require_once "view/template.php";
?>