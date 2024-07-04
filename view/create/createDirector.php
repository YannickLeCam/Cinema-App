<?php
ob_start();
if (isset($_SESSION['directorData'])) {
    $data = $_SESSION['directorData'];
    unset($_SESSION['directorData']);
}
use Service\NavService;
$navService= new NavService();

echo $navService->navCreate();
?>

<form action="./index.php?action=createDirector" method="post">

    <div class="form-floating mb-3">
        <input type="text" name="firstname" id="floatingInput" class="form-control" value="<?=isset($data["firstname"])?htmlentities($data["firstname"]):""?>" placeholder="Entrer le prénom :">
        <label for="floatingInput">Entrer le prénom :</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="name" id="floatingInput" class="form-control" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>" placeholder="EEntrer le nom :">
        <label for="floatingInput">Entrer le nom :</label>
    </div>


    <div class="form-sub-container">

        <label for="birthday">Date d'anniversaire:</label>
        <label for="genre">Genre :</label>
        <input type="date" id="birthday" name="birthday" class="form-control" value="<?=(isset($data['birthday']) ? $data['birthday'] :"")?>">
        <select name="genre" id="" class="form-select-lg mb-3">
            <option value="Male" <?=(isset($data['genre'])? ($data['genre']=='Male'?"selected":"" ):"" )?>>Male</option>
            <option value="Female" <?=(isset($data['genre'])? ($data['genre']=='Female'?"selected":"" ):"" )?>>Female</option>
            <option value="Other" <?=(isset($data['genre'])? ($data['genre']=='Other'?"selected":"" ):"" )?>>Other</option>
        </select>
    </div>

    <input type="submit" name="SubmitActorForm" value="Ajouter" class="btn btn-secondary">
</form>


<?php
$title = "Nouveau Réalisateur";
$titleText = "Nouveau Réalisateur";
$content = ob_get_clean();
require_once "view/template.php";
?>