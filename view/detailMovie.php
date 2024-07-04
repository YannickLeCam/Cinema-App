<?php ob_start();
$dateRelease = new \DateTime($movie['date_release']);

// Formate the date in french
$formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
$formattedDate = $formatter->format($dateRelease);
use Service\CardService;

$cardService = new CardService();
?>

<div id="wrapper">
    <img id="afficheDetail" src="<?=$movie['poster']?>" alt="l'affiche du film <?=$movie["name"]?>">
    <div id="contentDetailMovie">
        <h2>Information</h2>
        <p>Le film <?=$movie['name']?> est sortie en France le <?=$formattedDate?>, le film a une durée de <?=$movie['duration']?> minute<?=$movie['duration']>1 ? "s":""?> et été évalué <?=$movie['rate']?>/10.</p>
        <p>L'oeuvre cinématographique a été réalisée par <a href="./index.php?action=detailDirector&id=<?=$director['id_director']?>"><?=$director['name'] . ' '. $director['firstname']?></a></p>
        <h4>Genre</h3>
        <ul>
        <?php
            foreach ($listTypes as $type) {
                echo "<a href='./index.php?action=detailType&id=".$type['id_type']."'><li class='btn btn-secondary'>".$type['name']."</li></a>";
            }
        
        ?>
        </ul>
        <h4>Synopsis</h4>
        <?=$movie['synopsis']?>
        <?=!empty($listCasting)?"<h2>Casting</h2>":""?>
        <?=$cardService->createListCasting($listCasting)?>
    </div>



</div>





<?php
$title = $movie['name'];
$titleText = $movie['name'];
$content = ob_get_clean();
require_once "view/template.php";
?>