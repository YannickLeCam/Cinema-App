<?php 


namespace Service;

class NavService {

/**
 * The `navList` function generates a navigation menu with links that have active class based on the
 * current action in the URL.
 * 
 * Returns:
 *   The `navList()` function returns a string containing HTML code for a navigation menu. The menu
 * includes links for different actions such as listing movies, actors, roles, directors, and genres.
 * The active link is determined based on the `action` parameter in the URL. The active link will have
 * a class of "active" applied to it.
 */
    public function navList() : string {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }else {
            $action=null;
        }
        return <<<HTML
<nav id="navList">
    <ul>
        <li><a href="./index.php?action=listMovies" class="{$this->getActiveClass($action, 'listMovies')}">Films</a></li>
        <li><a href="./index.php?action=listActors" class="{$this->getActiveClass($action, 'listActors')}">Acteurs</a></li>
        <li><a href="./index.php?action=listRoles" class="{$this->getActiveClass($action, 'listRoles')}">Roles</a></li>
        <li><a href="./index.php?action=listDirectors" class="{$this->getActiveClass($action, 'listDirectors')}">Réalisateurs</a></li>
        <li><a href="./index.php?action=listTypes" class="{$this->getActiveClass($action, 'listTypes')}">Genre</a></li>
    </ul>
</nav>
HTML;
    }

    public function navCreate() : string {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }else {
            $action=null;
        }
        return <<<HTML
<nav id="navCreate">
    <ul>
        <li><a href="./index.php?action=createMovie" class="nav-link {$this->getActiveClass($action, 'createMovie')}">Films</a></li>
        <li><a href="./index.php?action=createActor" class="nav-link {$this->getActiveClass($action, 'createActor')}">Acteurs</a></li>
        <li><a href="./index.php?action=createRole" class="nav-link {$this->getActiveClass($action, 'createRole')}">Roles</a></li>
        <li><a href="./index.php?action=createDirector" class="nav-link {$this->getActiveClass($action, 'createDirector')}">Réalisateurs</a></li>
        <li><a href="./index.php?action=createType" class="nav-link {$this->getActiveClass($action, 'createType')}">Genre</a></li>
    </ul>
</nav>
HTML;
    }

    private function getActiveClass($currentAction, $actionName) : string {
        return $currentAction === $actionName ? 'active' : '';
    }
}

