<?php ob_start();

$data = $request->fetchAll();

?>



<pre>
    <?=var_dump($data)?>
</pre>







<?php
$title = "Liste des Roles";
$titleText = "Liste des Roles";
$content = ob_get_clean();
require_once "view/template.php";
?>