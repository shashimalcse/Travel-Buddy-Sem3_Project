<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;

class Imformation extends Authenticated{

    protected function before(){
        
        parent::before();
        $this->user = Auth::getUser();

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
    public function addVehicalAction(){

        if($this->user->addVehical($_POST,$_FILES)){

            Flash::addMessage('Saved');

            $this->redirect('/php-mvc-master/public/profile/show');
        }else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/vehical_imformation.html');
        }


    }
}
