<?php

namespace App\Controllers;

use PDO;
use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;


class Guidesearch extends \Core\Controller
{

    public static function showAction(){

        if(!isset($_POST['dayfilter'])){
            $day='All';
        }
        else{
            $day=$_POST['dayfilter'];
        }

        View::renderTemplate('GuideSearch/guideview.html',['data' => static::getGuide(),'day' => $day]);

    }

    public static function getGuide(){

        return User::getGuide();
    }    
}