<?php

namespace App\Controllers;

use PDO;
use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\User;

class Places extends \Core\Controller{


    public function showAction(){

        View::renderTemplate('Places/placegallery.html',['data' => static::getPlaces()]);
        
    }
    public function addAction(){
        if(Auth::getUser()){

            View::renderTemplate('Places/addplace.html');    

        }
        else{

            Flash::addMessage('Login First');

            parent::redirect('/php-mvc-master/public/login');
        }

    }
    public static function getPlaces(){

        return User::getPlaces();
    }
    
    public static function addPlaceAction(){
    
        if(User::addPlaceAction($_POST,$_FILES)){ 
            parent::redirect('/php-mvc-master/public/places/show');
        }
        else{
            View::renderTemplate('Places/addplace.html'); 
        }

    }

}

