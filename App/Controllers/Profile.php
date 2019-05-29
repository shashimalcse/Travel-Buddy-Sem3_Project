<?php

namespace App\Controllers;

use \Core\View;
use  \App\Auth;
use \App\Flash;

class Profile extends Authenticated{

    protected function before(){
        
        parent::before();
        $this->user = Auth::getUser();

    }

    public function showAction(){

        View::renderTemplate('Profile/show.html',['user' => $this->user]);

    }
    public function editAction(){

        View::renderTemplate('Profile/edit.html',['user' => $this->user]);
    }
    public function updateAction(){

        

        if($this->user->updateProfile($_POST)){

            Flash::addMessage('Changes saved');

            $this->redirect('/php-mvc-master/public/profile/show');
        }else{

            View::renderTemplate('Profile/edit.html',['user' => $this->user]);
        }
    }

    public function photoAction(){

        View::renderTemplate('Profile/editpp.html',['user' => $this->user]);

    }

    public function addPhotoAction(){
        $user_id = $_SESSION['user_id'];
        $image=$_FILES['userfile'];
        echo var_dump($image);
        $directoryName = '../Resource/Profile/' . $user_id . '/';
        if(!file_exists($directoryName)){
            mkdir($directoryName, 0755, true);
        }
        
        move_uploaded_file($image['tmp_name'],$directoryName.$user_id.".png");
        parent::redirect('/php-mvc-master/public/profile/show');




    }

}