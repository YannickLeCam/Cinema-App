<?php ob_start();



use Service\NavService;

$navService=new NavService();
echo $navService->navList();
?>



<pre>
    <?=var_dump($listRoles)?>
</pre>







<?php
$title = "Liste des Roles";
$titleText = "Liste des Roles";
$content = ob_get_clean();
require_once "view/template.php";
?>