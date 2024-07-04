<?php ob_start();
$dateRelease = new \DateTime($movie['date_release']);

// Formate the date in french
$formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE);
$formattedDate = $formatter->format($dateRelease);
use Service\CardService;

$cardService = new CardService();
?>

<div id="wrapper">
    <img src="<?=$movie['poster']?>" alt="l'affiche du film <?=$movie["name"]?>">
    <h2>Information</h2>
    <p>Le film <?=$movie['name']?> est sortie en France le <?=$formattedDate?>, le film a une durée de <?=$movie['duration']?> minute<?=$movie['duration']>1 ? "s":""?> et été évalué <?=$movie['rate']?>/10.</p>
    <p>L'oeuvre cinématographique a été réalisée par <a href="./index.php?action=detailDirector&id=<?=$director['id_director']?>"><?=$director['name'] . ' '. $director['firstname']?></a></p>
    <h4>Genre</h3>
    <ul>
    <?php
        foreach ($listTypes as $type) {
            echo "<li><a href='./index.php?action=detailType&id=".$type['id_type']."'>".$type['name']."</a></li>";
        }
    
    ?>
    </ul>
    <h2>Acteur</h2>

</div>

<pre>
    <?=var_dump($movie,$listCasting,$listTypes,$director)?>
</pre>







<?php
$title = $movie['name'];
$titleText = $movie['name'];
$content = ob_get_clean();
require_once "view/template.php";
?>