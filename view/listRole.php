<?php ob_start();
?>



<pre>
    <?=var_dump($listRole)?>
</pre>







<?php
$title = "Liste des Roles";
$titleText = "Liste des Roles";
$content = ob_get_clean();
require_once "view/template.php";
?>