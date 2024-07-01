<?php ob_start();



require 'public/elements/navList.php';
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