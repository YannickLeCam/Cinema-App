<?php

if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]);
}else {
    $error=null;
}
if (isset($_SESSION["success"])) {
    $success = $_SESSION["success"];
    unset($_SESSION["success"]);
}else {
    $success=null;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header id="header">
        <div id="logo">
            <p>Cin<span>Almanach</span></p>
        </div>
        <nav id="menu">
            <ul>
                <li class="linkNav"><a href="./index.php">Accueil</a></li>
                <a href="./index.php?action=listMovies"><li>Catalogue</li></a>
                <a href="./index.php?action=createMovie"><li>Insertion</li></a>
            </ul>
        </nav>
        <i class="fa-solid fa-bars" id="openBurgerMenu"></i>
        <i class="fa-solid fa-xmark hide" id="closeBurgerMenu"></i>
        
    </header>
    <div id="content">
        <h1><?=$titleText ?></h1>

        <?=$success?"<p class=\"alert alert-success\" role=\"alert\">$success</p>":""?>
        <?=$error?"<p class=\"alert alert-danger\" role=\"alert\">$error</p>":""?>
        <?=$content?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="public/js/script.js"></script>
</body>
</html>