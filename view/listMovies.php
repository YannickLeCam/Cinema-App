<?php ob_start();


function createCardsMovies (array $listMovies):string{
    $htmlContent= "";
    foreach ($listMovies as $movie) {
        $htmlContent .= '<a href="./index.php?action=detailMovie&id='.$movie['id_movie'].'">';
        $htmlContent .= '<div class="Card"> <div class="CardHeader"><img src="'.$movie['poster'].'" alt=""></div> <h4>'.$movie['name'].'</h4>  <p>'.$movie['rate'].'</p> </div> ';
        $htmlContent .= '</a>';
    }
    return $htmlContent;
}

use Service\NavService;

$navService=new NavService();
echo $navService->navList();
?>


<div id="listCard">
    <div id="research">
        <form action="./index.php?action=listMovies" method="post">
            <input type="text" name="titleContain" id="">
            <input type="submit" name="SubmitSearchButton" value="Rechercher">
        </form>
    </div>
    <?=createCardsMovies($listMovies)?>
</div>

<pre>
    
</pre>







<?php
$title = "Liste des films";
$titleText = "Liste des films";
$content = ob_get_clean();
require_once "view/template.php";
?>