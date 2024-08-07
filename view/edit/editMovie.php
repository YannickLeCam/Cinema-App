<?php ob_start();

/**
 * The function `createInputType` generates HTML checkboxes based on a list of types provided.
 * 
 * Args:
 *   listTypes: An array containing information about different types. Each element in the array should
 * have 'name' and 'id_type' keys to represent the type name and type ID respectively.
 * 
 * Returns:
 *   The function `createInputType` returns a HTML content string that contains a series of checkboxes
 * with labels based on the input list of types. Each checkbox corresponds to a type in the list, with
 * the type name as the label and the type ID as the value.
 */
function createInputType($listTypes,array $selectedTypes){
    $htmlContent = "<div id='typeCheckbox'>";
    foreach ($listTypes as $key=>$type) {
        $check ="";
        foreach ($selectedTypes as $selectedType) {
            if($selectedType['id_type']==$type['id_type']){
                $check="checked";
            }
        }
        $typeName = $type['name'];
        $typeId = $type['id_type'];
        $htmlContent .= <<<HTML
        <input type="checkbox" class="btn-check" value=$typeId name=type[] id="btn-check-$key" autocomplete="off" $check>
        <label class="btn" for="btn-check-$key">$typeName</label>
HTML;
    }
    $htmlContent .= "</div>";
    return $htmlContent;
}
/**
 * The function `createSelectDirectors` generates a dropdown select menu with director names and IDs
 * from a given list of directors.
 * 
 * Args:
 *   listDirectors:  is an array containing information about directors. Each element in
 * the array is an associative array with keys like 'name', 'firstname', and 'id_director' to store the
 * respective details of a director.
 * 
 * Returns:
 *   The function `createSelectDirectors` returns an HTML select element populated with options for
 * each director in the provided list. Each option includes the director's full name and their
 * corresponding ID.
 */
function createSelectDirectors($listDirectors,$idDirectorSelected){
    $htmlContent = "<select name='id_director' id='directorSelect' class='form-select mb-3'>";
    foreach ($listDirectors as $director) {
        if ($director['id_director']==$idDirectorSelected) {
            $selected = "selected";
        }else {
            $selected = "";
        }
        $directorName = $director['name'].' '.$director['firstname'];
        $directorId = $director['id_director'];
        $htmlContent.= <<<HTML
            <option value=$directorId $selected>$directorName</option>
HTML;
    }
    $htmlContent .= "</select>";
    return $htmlContent;
}


function createCastingEdit(array $listActors,array $listRoles,array $listSelectedActorsRoles):string{
    $htmlContent="";
    if (empty($listSelectedActorsRoles)) {
        //On en créer un vièrge pour eviter de connecter le JS a la BDD 
            //Actor part
            $htmlContent.="<div class='inputActorRole'>";
            $htmlContent .= "<select name=casting[actor][] id='directorSelect' class='form-select form-select-lg' aria-label='Large select example'>";
            $htmlContent .= "<option value='0' selected>Choisir un acteur</option>";
            foreach ($listActors as $actor) {
                $actorName = $actor['name'].' '.$actor['firstname'];
                $actorId = $actor['id_actor'];
                $htmlContent.= <<<HTML
                    <option value="$actorId">$actorName</option>
HTML;
            }
            $htmlContent .= "</select>";
    
            //role part
            $htmlContent .= "<select name=casting[role][] id='directorSelect' class='form-select form-select-lg' aria-label='Large select example'>";
            $htmlContent .= "<option value='0' selected>Choisir un role</option>";
            foreach ($listRoles as $role) {
                $roleName = $role['name'];
                $roleId = $role['id_role'];
                $htmlContent.= <<<HTML
                    <option value="$roleId">$roleName</option>
HTML;
            }
            $htmlContent .= "</select>";
            $htmlContent .= "<i class='fa-solid fa-xmark deleteCastingInput'></i>";
            $htmlContent.="</div>";
    }else {
        foreach ($listSelectedActorsRoles as $selected) {
            //Actor part
            $htmlContent.="<div class='inputActorRole'>";
            $htmlContent .= "<select name=casting[actor][] id='directorSelect' class='form-select form-select-lg' aria-label='Large select example'>";
            foreach ($listActors as $actor) {
                $actorName = $actor['name'].' '.$actor['firstname'];
                $actorId = $actor['id_actor'];
                if ($selected['id_actor']==$actor['id_actor']) {
                    $complement="selected";
                }else {
                    $complement="";
                }
                $htmlContent.= <<<HTML
                    <option value="$actorId" $complement>$actorName</option>
HTML;
            }
            $htmlContent .= "</select>";
    
            //role part
            $htmlContent .= "<select name=casting[role][] id='directorSelect' class='form-select form-select-lg' aria-label='Large select example'>";
            foreach ($listRoles as $key=>$role) {
                $roleName = $role['name'];
                $roleId = $role['id_role'];
                if ($roleId==$selected['id_role']) {
                    $complement="selected";
                }else {
                    $complement="";
                }
                $htmlContent.= <<<HTML
                    <option value="$roleId" $complement>$roleName</option>
HTML;
            }
            $htmlContent .= "</select>";
            $htmlContent .= "<i class='fa-solid fa-xmark deleteCastingInput'></i>";
            $htmlContent.="</div>";
        }
    
    }
    

    return $htmlContent;
}
?>

<form action="./index.php?action=editMovie&id=<?=$data['movie']['id_movie']?>" method="post">
    <h2>Film</h2>
    <div class="form-floating mb-3">
        <input type="text" name="name" id="floatingInput" class="form-control" value="<?=isset($data['movie']["name"])?htmlentities($data['movie']["name"]):""?>" placeholder="Entrer le titre du film :">
        <label for="floatingInput">Entrer le tire du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="date" id="floatingInput" name="date_release" class="form-control" value="<?=(isset($data['movie']['date_release']) ? $data['movie']['date_release'] :"")?>" placeholder="Date de sortie du film :">
        <label for="floatingInput">Date de sortie du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" name="duration" id="floatingInput" class="form-control" min=0 value="<?=(isset($data['movie']['duration']) ? $data['movie']['duration'] :"")?>" placeholder="Entrer la durée du film :">
        <label for="floatingInput">Entrer la durée du film :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="rate" id="floatingInput" class="form-control" value="<?=(isset($data['movie']['rate']) ? $data['movie']['rate'] :"")?>" placeholder="Evaluer le film (sur 10) :">
        <label for="floatingInput">Evaluer le film (sur 10) :</label>
    </div>

    <div class="form-floating mb-3">
        <input type="url" name="posterURL" id="floatingInput" class="form-control" value="<?=(isset($data['movie']['poster']) ? $data['movie']['poster'] :"")?>" placeholder="Entrer l'affiche du film :">
        <label for="floatingInput">Entrer l'affiche du film :</label>    
    </div>

    <label for="type">Entrer le(s) genre(s) du film :</label>
    <?=createInputType($listTypes, $data['types'])?>

    <label for="director">Entrer le réalisateur :</label>
    <?=createSelectDirectors($listDirectors,$data['movie']['id_director'])?>

    <div class="form-floating">
        <textarea name="synopsis" id="floatingTextarea2" class="form-control" placeholder="Entrer le synopsis du film :"><?=(isset($data['movie']['synopsis']) ? $data['movie']['synopsis'] :"")?></textarea>
        <label for="floatingTextarea2">Entrer le synopsis du film :</label>
    </div>

    <div id="castingParts">
        <h2>Casting</h2>
        <div id='gridContainer'>
            <div class="inputActorRole">            
                <h4>Acteurs</h4>
                <h4>Roles</h4>
                <h4>Enlever</h4>
            </div>
            <?=createCastingEdit($listActors,$listRoles,$data['casting'])?>
        </div>
        <div class="btn btn-success" id="buttonAddNewLine"><i class="fa-solid fa-user-plus"></i> Ajouter un nouveau personnage</div>
    </div>
    
    <div id="buttonEditMovie">
        <input type="submit" class="btn btn-danger" name="submitDeleteMovie" value="Supprimer le film">
        <input type="submit" class="btn btn-secondary" name="submitEditMovie" value="Ajouter">
    </div>
   

</form>



<script src="public/js/editButton.js"></script>

<?php
$title = "Edit-".$data['movie']['name'];
$titleText = "Edit-".$data['movie']['name'];
$content = ob_get_clean();
require_once "view/template.php";
?>