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
    <div class="form-floating mb-3">
        <input type="text" name="name" id="floatingInput" class="form-control" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>" placeholder="Entrer le role :">
        <label for="floatingInput">Entrer le role :</label>
    </div>
    <input type="submit" class="btn btn-secondary" name="SubmitTypeForm" value="Ajouter">
</form>



<?php
$title = "Nouveau type";
$titleText = "Nouveau type";
$content = ob_get_clean();
require_once "view/template.php";
?>