<?php ob_start();
?>



<pre>
    <?=var_dump($type,$listMovies)?>
</pre>







<?php
$title = "Liste des genres de films";
$titleText = "Liste des genres de films";
$content = ob_get_clean();
require_once "view/template.php";
?>