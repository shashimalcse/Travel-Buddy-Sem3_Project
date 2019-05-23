<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Imformation extends Authenticated{

    public function newAction(){

        View::renderTemplate('Imformation/new.html');
    }
    public function chooseAction(){

        View::renderTemplate('Imformation/choose.html');        
    }

    public function shopAction(){
        
        View::renderTemplate('Imformation/shop_imformation.html');

    }
    public function guiderAction(){
        
        View::renderTemplate('Imformation/guider_imformation.html');

    }
    public function hotelAction(){
        
        View::renderTemplate('Imformation/hotel_imformation.html');

    }
    public function vehicalAction(){
        
        View::renderTemplate('Imformation/vehical_imformation.html');

    }
}
