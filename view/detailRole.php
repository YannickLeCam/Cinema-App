<?php ob_start();

$roleName=$role['name'];

use Service\CardService;

$cardService = new CardService();
?>

<h2>Filmography</h2>
<?=$cardService->createListFilmographyRole($listCasting)?>




<?php
$title = $roleName;
$titleText = $roleName;
$content = ob_get_clean();
require_once "view/template.php";
?>