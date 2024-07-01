<?php ob_start();

use Service\NavService;

$navService=new NavService();
echo $navService->navList();
?>



<pre>
    <?=var_dump($listTypes)?>
</pre>







<?php
$title = "Liste des genres de films";
$titleText = "Liste des genres de films";
$content = ob_get_clean();
require_once "view/template.php";
?>