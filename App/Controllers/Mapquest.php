<?php

namespace App\Controllers;

use \Core\View;

class Mapquest extends \Core\Controller{

    public function loadAction(){

         View::renderTemplate('Map/mapquest.html');
    }
}