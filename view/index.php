<?php ob_start();
?>






<?php
$title = "Cinema";
$titleText = "Index";
$content = ob_get_clean();
require_once "view/template.php";
?>