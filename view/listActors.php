<?php ob_start();



$data = $request->fetchAll();
?>



<pre>
    <?=var_dump($data)?>
</pre>







<?php
$title = "Liste des Acteurs";
$titleText = "Liste des Acteurs";
$content = ob_get_clean();
require_once "view/template.php";
?>