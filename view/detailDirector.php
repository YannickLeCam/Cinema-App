<?php ob_start();

?>



<pre>
    <?=var_dump($director,$listMovies)?>
</pre>







<?php
$title = "Nom du Réalisateur";
$titleText = "Nom du Réalisateur";
$content = ob_get_clean();
require_once "view/template.php";
?>