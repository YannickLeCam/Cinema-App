<?php

namespace Controller;

use Model\RoleManager;

class RoleController {

    public function listRole(){
        $roleManager = new RoleManager();
        $listRoles=$roleManager->getRoles();

        require 'view/listRole.php';
    }

    /**
 * This PHP function retrieves details of a specific role, including the name of the role and
 * information about the actors who played that role in movies.
 * 
 * @param int id_role The `detailRole` function takes an integer parameter `` which represents
 * the ID of a role. This function retrieves the name of the role from the `role` table and the details
 * of actors who played that role from the database. Finally, it includes the `detailRole.php` view
 */
    public function detailRole(int $id_role){
        $managerRole = new RoleManager();
        $role = $managerRole->getRoleDetail($id_role);
        $listCasting =  $managerRole->getActorMovieOfRole($id_role);
        require "view/detailRole.php";
    }

}