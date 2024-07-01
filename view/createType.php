<?php
ob_start();
if (isset($_SESSION['typeData'])) {
    $data = $_SESSION['typeData'];
    unset($_SESSION['typeData']);
}

use Service\NavService;
$navService= new NavService();

echo $navService->navCreate();
?>

<form action="./index.php?action=createType" method="post">
    <label for="name">Entrer le nom du genre :</label>
    <input type="text" name="name" id="" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>">
    <input type="submit" name="SubmitTypeForm" value="Ajouter">
</form>



<?php
$title = "Nouveau type";
$titleText = "Nouveau type";
$content = ob_get_clean();
require_once "view/template.php";
?>