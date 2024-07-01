<?php ob_start();


require 'public/elements/navList.php';
?>



<pre>
    <?=var_dump($directors)?>
</pre>







<?php
$title = "Liste des réalisateurs";
$titleText = "Liste des réalisateurs";
$content = ob_get_clean();
require_once "view/template.php";
?>