<?php ob_start();


use Service\NavService;

$navService=new NavService();
echo $navService->navList();
?>


<pre>
    <?=var_dump($listMovies)?>
</pre>







<?php
$title = "Liste des films";
$titleText = "Liste des films";
$content = ob_get_clean();
require_once "view/template.php";
?>