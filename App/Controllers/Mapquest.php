<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Mapquest extends \Core\Controller{

    public function loadAction(){

         View::renderTemplate('Map/mapquest.html');
    }

    public static function currentUserAction(){

        echo ($_SESSION['user_id']);
    }
}