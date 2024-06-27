<?php
ob_start();
if (isset($_SESSION['typeData'])) {
    $data = $_SESSION['typeData'];
    unset($_SESSION['typeData']);
}
?>

<form action="./index.php?action=newType" method="post">
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