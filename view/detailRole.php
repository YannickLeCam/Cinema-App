<?php ob_start();

?>



<pre>
    <?=var_dump($role,$listCasting)?>
</pre>







<?php
$title = "Nom du Role";
$titleText = "Nom du Role";
$content = ob_get_clean();
require_once "view/template.php";
?>