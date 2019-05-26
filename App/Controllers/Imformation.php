<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;
use \App\Auth;
use \App\Flash;
use \App\Models\ImformationM;


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
    public function editMenuAction(){
        
        View::renderTemplate('Imformation/editmenu.html',['uservehicalinfo' => static::getVehicalBusiness(),
                                                        'userhotelinfo' => static::getHotelBusiness()
                                                        ,'usershopinfo' => static::getShopBusiness()
                                                        ,'userguiderinfo' => static::getGuiderBusiness()]);
        
        

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
    public function addHotelAction(){

        if($this->user->addHotel($_POST,$_FILES)){

            Flash::addMessage('Saved');

            $this->redirect('/php-mvc-master/public/profile/show');
        }else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/hotel_imformation.html');
        }


    }
    public function addShopAction(){

        if($this->user->addShop($_POST,$_FILES)){

            Flash::addMessage('Saved');

            $this->redirect('/php-mvc-master/public/profile/show');
        }else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/shop_imformation.html');
        }


    }
    public function addGuiderAction(){

        if($this->user->addGuider($_POST)){

            Flash::addMessage('Saved');

            $this->redirect('/php-mvc-master/public/profile/show');
        }else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/guider_imformation.html');
        }


    }
    public static function getVehicalBusiness(){
        $user = Auth::getUser();
        $userinfo = ImformationM::findByID('vehical',$user->id,'user_id');
        return $userinfo;
    }
    public static function getHotelBusiness(){
        $user = Auth::getUser();
        $userinfo = ImformationM::findByID('hotel',$user->id,'user_id');
        return $userinfo;
    }
    public static function getShopBusiness(){
        $user = Auth::getUser();
        $userinfo = ImformationM::findByID('shop',$user->id,'user_id');
        return $userinfo;
    }
    public static function getGuiderBusiness(){
        $user = Auth::getUser();
        $userinfo = ImformationM::findByID('guider',$user->id,'user_id');
        return $userinfo;
    }

    public function vehicalDelAction(){
        $id = $this->route_params['id'];
        if(ImformationM::deleteByID('vehical',$id)){

            Flash::addMessage('Removed');

            $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

        
        else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/editmenu.html');
        }
}
public function hotelDelAction(){
    $id = $this->route_params['id'];
    if(ImformationM::deleteByID('hotel',$id)){

        Flash::addMessage('Removed');

        $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

    
    else{

        Flash::addMessage('Please try again',Flash::WARNING);

        View::renderTemplate('Imformation/editmenu.html');
    }
}
public function shopDelAction(){
    $id = $this->route_params['id'];
    if(ImformationM::deleteByID('shop',$id)){

        Flash::addMessage('Removed');

        $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

    
    else{

        Flash::addMessage('Please try again',Flash::WARNING);

        View::renderTemplate('Imformation/editmenu.html');
    }
}
public function guiderDelAction(){
    $id = $this->route_params['id'];
    if(ImformationM::deleteByID('guider',$id)){

        Flash::addMessage('Removed');

        $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

    
    else{

        Flash::addMessage('Please try again',Flash::WARNING);

        View::renderTemplate('Imformation/editmenu.html');
    }
}

    public function vehicalEditAction(){
        $id = $this->route_params['id'];
        
        $uservehicalinfo = ImformationM::findByID('vehical',$id,'id');
        View::renderTemplate('Imformation/vehicaledit.html',['uservehicalinfo' => $uservehicalinfo[0]]);


    }
    public function hotelEditAction(){
        $id = $this->route_params['id'];
        
        $userhotelinfo = ImformationM::findByID('hotel',$id,'id');
      
        View::renderTemplate('Imformation/hoteledit.html',['userhotelinfo' => $userhotelinfo[0]]);


    }
    public function shopEditAction(){
        $id = $this->route_params['id'];
        
        $userhotelinfo = ImformationM::findByID('shop',$id,'id');
      
        View::renderTemplate('Imformation/shopedit.html',['usershopinfo' => $usershopinfo[0]]);


    }
    public function guiderEditAction(){
        $id = $this->route_params['id'];
        
        $userguiderinfo = ImformationM::findByID('guider',$id,'id');
      
        View::renderTemplate('Imformation/guideredit.html',['userguiderinfo' => $userguiderinfo[0]]);


    }

    public function changeVehicalAction(){
        $id = $this->route_params['id'];
        if(ImformationM::updateImformation($_POST,'vehical',$id)){

            Flash::addMessage('Changed');

            $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

        
        else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/editmenu.html');
        }

    }
    public function changeHotelAction(){
        $id = $this->route_params['id'];
        if(ImformationM::updateImformation($_POST,'hotel',$id)){

            Flash::addMessage('Changed');

            $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

        
        else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/editmenu.html');
        }

    }
    public function changeShopAction(){
        $id = $this->route_params['id'];
        if(ImformationM::updateImformation($_POST,'shop',$id)){

            Flash::addMessage('Changed');

            $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

        
        else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/editmenu.html');
        }

    }
    public function changeGuiderAction(){
        $id = $this->route_params['id'];
        if(ImformationM::updateGuiderImformation($_POST,'guider',$id)){

            Flash::addMessage('Changed');

            $this->redirect('/php-mvc-master/public/Imformation/edit-menu');}

        
        else{

            Flash::addMessage('Please try again',Flash::WARNING);

            View::renderTemplate('Imformation/editmenu.html');
        }

    }
}