<?php ob_start();
?>



<pre>
    <?=var_dump($movie,$listCasting,$listTypes,$director)?>
</pre>







<?php
$title = "Nom du film";
$titleText = "Nom du film";
$content = ob_get_clean();
require_once "view/template.php";
?>