<?php ob_start();

$dataMovie = $requestMovie->fetch();
$dataCasting = $requestCasting->fetchAll();
?>



<pre>
    <?=var_dump($dataMovie,$dataCasting)?>
</pre>







<?php
$title = "Nom du film";
$titleText = "Nom du film";
$content = ob_get_clean();
require_once "view/template.php";
?>