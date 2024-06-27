<?php
if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]);
}
if (isset($_SESSION["success"])) {
    $success = $_SESSION["success"];
    unset($_SESSION["success"]);
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

    <div id="content">
        <h1><?=$titleText ?></h1>

        <?=isset($success)?"<p>$success</p>":""?>
        <?=isset($error)?"<p>$error</p>":""?>
        <?=$content?>
    </div>
    

    <script src="public/js/script.js"></script>
</body>
</html>