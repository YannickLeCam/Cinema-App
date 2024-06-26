<?php ob_start();

$dataActor = $requestActor->fetchAll();
$dataRole = $requestRole->fetch();
?>



<pre>
    <?=var_dump($dataActor,$dataRole)?>
</pre>







<?php
$title = "Nom du Role";
$titleText = "Nom du Role";
$content = ob_get_clean();
require_once "view/template.php";
?>