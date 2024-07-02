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
    
    <div class="form-floating mb-3">
        <input type="text" name="name" id="floatingInput" class="form-control" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>" placeholder="Entrer le nom du Role :">
        <label for="floatingInput">Entrer le nom du Role :</label>
    </div>
    <input type="submit" name="SubmitRoleForm" class="btn btn-secondary" value="Ajouter">
</form>



<?php
$title = "Nouveau Role";
$titleText = "Nouveau Role";
$content = ob_get_clean();
require_once "view/template.php";
?>