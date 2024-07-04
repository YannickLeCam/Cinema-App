<?php ob_start();




use Service\CardService;

$cardService = new CardService();
?>



<div id="listCard">
    <div id="research">
        <form action="./index.php?action=listMovies" method="post">
            <input type="text" name="titleContain" id="">
            <input type="submit" name="SubmitSearchButton" value="Rechercher">
        </form>
    </div>
    <?=$cardService->createCardsMovies($listMovies)?>
</div>






<?php
$title = $type['name'];
$titleText = $type['name'];
$content = ob_get_clean();
require_once "view/template.php";
?>