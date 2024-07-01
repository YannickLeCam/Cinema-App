<nav id="navCreate">
    <ul>
        <li><a href="./index.php?action=createMovies" class="<?=$_GET["action"]=="createMovies"?"active":""?>">Films</a></li>
        <li><a href="./index.php?action=createActors" class="<?=$_GET["action"]=="createActors"?"active":""?>">Acteurs</a></li>
        <li><a href="./index.php?action=createRoles" class="<?=$_GET["action"]=="createRoles"?"active":""?>">Roles</a></li>
        <li><a href="./index.php?action=createDirectors" class="<?=$_GET["action"]=="createDirectors"?"active":""?>">Réalisateurs</a></li>
        <li><a href="./index.php?action=createTypes" class="<?=$_GET["action"]=="createTypes"?"active":""?>">Genre</a></li>
    </ul>
</nav>