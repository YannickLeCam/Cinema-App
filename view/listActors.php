<?php ob_start()?>











<?php
$title = "Liste des Acteurs";
$titleText = "Liste des Acteurs";
$content = ob_get_clean();
require_once "view/template.php";
?>