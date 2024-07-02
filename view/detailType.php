<?php ob_start();




use Service\NavService;

$navService=new NavService();
echo $navService->navCreate();
?>



<pre>
    <?=var_dump($type,$listMovies)?>
</pre>







<?php
$title = "Liste des genres de films";
$titleText = "Liste des genres de films";
$content = ob_get_clean();
require_once "view/template.php";
?>