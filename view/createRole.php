<?php
ob_start();
if (isset($_SESSION['roleData'])) {
    $data = $_SESSION['roleData'];
    unset($_SESSION['roleData']);
}

use Service\NavService;
$navService= new NavService();

echo $navService->navCreate();
?>

<form action="./index.php?action=createRole" method="post">
    <label for="name">Entrer le nom du Role :</label>
    <input type="text" name="name" id="" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>">
    <input type="submit" name="SubmitRoleForm" value="Ajouter">
</form>



<?php
$title = "Nouveau Role";
$titleText = "Nouveau Role";
$content = ob_get_clean();
require_once "view/template.php";
?>