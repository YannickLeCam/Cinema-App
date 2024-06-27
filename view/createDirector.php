<?php
ob_start();
if (isset($_SESSION['directorData'])) {
    $data = $_SESSION['directorData'];
    unset($_SESSION['directorData']);
}
?>

<form action="./index.php?action=createDirector" method="post">
    <label for="name">Entrer le prénom :</label>
    <input type="text" name="firstname" id="" value="<?=isset($data["firstname"])?htmlentities($data["firstname"]):""?>">
    <label for="name">Entrer le nom :</label>
    <input type="text" name="name" id="" value="<?=isset($data["name"])?htmlentities($data["name"]):""?>">
    <label for="birthday">Date d'anniversaire:</label>
    <input type="date" id="birthday" name="birthday" value="<?=(isset($data['birthday']) ? $data['birthday'] :"")?>">
    <label for="genre">Sexe :</label>
    <select name="genre" id="">
        <option value="Male" <?=(isset($data['genre'])? ($data['genre']=='Male'?"selected":"" ):"" )?>>Male</option>
        <option value="Female" <?=(isset($data['genre'])? ($data['genre']=='Female'?"selected":"" ):"" )?>>Female</option>
        <option value="Other" <?=(isset($data['genre'])? ($data['genre']=='Other'?"selected":"" ):"" )?>>Other</option>
    </select>
    <input type="submit" name="SubmitDirectorForm" value="Ajouter">
</form>



<?php
$title = "Nouveau Role";
$titleText = "Nouveau Role";
$content = ob_get_clean();
require_once "view/template.php";
?>