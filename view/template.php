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
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <header>
        <div id="logo">
            <p>Cin<span>Almanach</span></p>
        </div>
        <nav>
            <ul>
                <li class="linkNav"><a href="./index.php">Accueil</a></li>
                <a href="./index.php?action=listMovies"><li>Catalogue</li></a>
                <a href="./index.php?action=createMovie"><li>Insertion</li></a>
            </ul>
        </nav>

    </header>
    <div id="content">
        <h1><?=$titleText ?></h1>

        <?=$success?"<p>$success</p>":""?>
        <?=$error?"<p>$error</p>":""?>
        <?=$content?>
    </div>
    

    <script src="public/js/script.js"></script>
</body>
</html>