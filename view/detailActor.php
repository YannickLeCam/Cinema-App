<?php ob_start();

$dataActor = $requestActor->fetch();
$dataRole = $requestRole->fetchAll();
?>



<pre>
    <?=var_dump($dataActor,$dataRole)?>
</pre>







<?php
$title = "Liste des films";
$titleText = "Liste des films";
$content = ob_get_clean();
require_once "view/template.php";
?>