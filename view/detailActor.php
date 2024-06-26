<?php ob_start();

$dataActor = $requestActor->fetch();
$dataRole = $requestRole->fetchAll();
?>



<pre>
    <?=var_dump($dataActor,$dataRole)?>
</pre>







<?php
$title = "Nom de l'Acteur";
$titleText = "Nom de l'Acteur";
$content = ob_get_clean();
require_once "view/template.php";
?>