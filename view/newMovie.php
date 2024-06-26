<?php 
ob_start();
$typeMovie = $requestType ->fetchAll();
$director = $requestDirector->fetchAll();
$actor = $requestActor->fetchAll();
$role = $requestRole->fetchAll();
?>



<pre>
    <?=var_dump($typeMovie,$director,$actor,$role)?>
</pre>



<?php
$title = "Nouveau Film";
$titleText = "Nouveau Film";
$content = ob_get_clean();
require_once "view/template.php";
?>