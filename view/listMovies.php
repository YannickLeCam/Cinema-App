<?php ob_start();

?>



<pre>
    <?=var_dump($listMovies)?>
</pre>







<?php
$title = "Liste des films";
$titleText = "Liste des films";
$content = ob_get_clean();
require_once "view/template.php";
?>