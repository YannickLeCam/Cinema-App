<?php ob_start();


require 'public/elements/navList.php';
?>



<pre>
    <?=var_dump($listActors)?>
</pre>







<?php
$title = "Liste des Acteurs";
$titleText = "Liste des Acteurs";
$content = ob_get_clean();
require_once "view/template.php";
?>