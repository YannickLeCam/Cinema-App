<nav id="navList">
    <ul>
        <li><a href="./index.php?action=listMovies" class="<?=$_GET["action"]=="listMovies"?"active":""?>">Films</a></li>
        <li><a href="./index.php?action=listActors" class="<?=$_GET["action"]=="listActors"?"active":""?>">Acteurs</a></li>
        <li><a href="./index.php?action=listRoles" class="<?=$_GET["action"]=="listRoles"?"active":""?>">Roles</a></li>
        <li><a href="./index.php?action=listDirectors" class="<?=$_GET["action"]=="listDirectors"?"active":""?>">Réalisateurs</a></li>
        <li><a href="./index.php?action=listTypes" class="<?=$_GET["action"]=="listTypes"?"active":""?>">Genre</a></li>
    </ul>
</nav>