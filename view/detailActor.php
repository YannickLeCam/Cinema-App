<?php ob_start();
?>



<pre>
    <?=var_dump($actor,$filmography)?>
</pre>







<?php
$title = "Nom de l'Acteur";
$titleText = "Nom de l'Acteur";
$content = ob_get_clean();
require_once "view/template.php";
?>