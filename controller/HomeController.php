<?php

namespace Controller;

class HomeController {
    /**
     * The index function in PHP requires and includes the view/index.php file.
     */
    public function index(){
        require "view/index.php";
    }
}

?>