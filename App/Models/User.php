<?php

namespace App\Models;

use PDO;
use \App\Token;
use \App\Mail;
use \Core\View;
use \App\Models\ImformationM;


/**
 * Example user model
 *
 * PHP version 7.0
 */
class User extends \Core\Model{
    
    public $errors=[];

    public function __construct($data=[]){

        foreach($data as $key=>$value){
            $this->$key=$value;
        }

    }

    public function save(){
        
        $this->validate();
        
        if(empty($this->errors)){
        $password_hash=password_hash($this->password,PASSWORD_DEFAULT);

        $token = new Token();
        $hashed_token = $token->getHash();
        $this->activation_token = $token->getValue();

        $sql='INSERT INTO users (name,email,password_hash,activation_hash) VALUES (:name,:email,:password_hash,:activation_hash)';

        $db=static::getDB();
        $stmt=$db->prepare($sql);

        $stmt->bindValue(':name',$this->name,PDO::PARAM_STR);
        $stmt->bindValue(':email',$this->email,PDO::PARAM_STR);
        $stmt->bindValue(':password_hash',$password_hash,PDO::PARAM_STR);
        $stmt->bindValue(':activation_hash',$hashed_token,PDO::PARAM_STR);

        return $stmt->execute();
    }

        return false;

    }

    public function validate(){

         if($this->name==''){
             $this->errors[]='Name is Required';
         }
         if(filter_var($this->email,FILTER_VALIDATE_EMAIL)===false){
             $this->errors[]='Inavalid Email';
         }
         if(static::emailExists($this->email,$this->id ?? null)){
             $this->errors[]='Email already taken';
         }
         if(isset($this->password)){
         if(strlen($this->password)<8){
             $this->errors[]='Please enter at least 8 characters for the password';
         }
         if(preg_match('/.*[a-z]+.*/i',$this->password)==0){
             $this->errors[]='Password needs at least one letter';
         }
         if(preg_match('/.*\d+.*/i',$this->password)==0){
            $this->errors[]='Password needs at least one number';
        }}

    }

    public static function emailExists($email,$ignore_id = null){

        $user = static::findByEmail($email);

        if($user){
            if($user->id != $ignore_id){
                return true;

            }
        }
        return false;

    }

    public static function findByEmail($email){

        $sql='SELECT * FROM users WHERE email = :email';

        $db=static::getDB();
        $stmt=$db->prepare($sql);
        $stmt->bindValue(':email',$email,PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());

        $stmt->execute();

        return $stmt->fetch();

    }

    public static function findByID($id){

        $sql='SELECT * FROM users WHERE id = :id';

        $db=static::getDB();
        $stmt=$db->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());

        $stmt->execute();

        return $stmt->fetch();

    }


    public static function authenticate($email,$password){

        $user=static::findByEmail($email);

        if($user && $user->is_active){
            if(password_verify($password,$user->password_hash)){
                return $user;
            }
        }
        return false;

    }

    public function rememberLogin(){

        $token = new Token();
        $hashed_token = $token->getHash();

        $this->remember_token = $token->getvalue();

        $this->expiry_timestamp = time() + 60*60*24*30;


        $sql = 'INSERT INTO remembered_logins (token_hash,user_id,expires_at) VALUES (:token_hash, :user_id, :expires_at)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':token_hash',$hashed_token,PDO::PARAM_STR);
        $stmt->bindValue(':user_id',$this->id,PDO::PARAM_INT);
        $stmt->bindValue(':expires_at', date('Y-m-d H:i:s',$this->expiry_timestamp),PDO::PARAM_STR);

        return $stmt->execute();
        }

        public static function sendPasswordReset($email){

            $user=static::findByEmail($email);

            if($user){
                if($user->startPasswordReset()){

                    $user->sendPasswordResetEmail();

                }

            }

        }

        protected function startPasswordReset(){

            $token = new Token();
            $hashed_token = $token->getHash();
            $this->password_reset_token= $token->getValue();

            $expiry_timestamp = time() + 60*60*2;

            $sql ='UPDATE users SET password_reset_hash = :token_hash ,
                    password_reset_expires_at = :expires_at WHERE id =:id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':token_hash',$hashed_token,PDO::PARAM_STR);
            $stmt->bindValue(':expires_at', date('Y-m-d H:i:s',$expiry_timestamp),PDO::PARAM_STR);
            $stmt->bindValue(':id',$this->id,PDO::PARAM_INT);
            
            return $stmt->execute();    
        }
        protected function sendPasswordResetEmail(){

            $url='http://' . $_SERVER['HTTP_HOST'] . '/php-mvc-master/public/password/reset/' . $this->password_reset_token;

            $text = View::getTemplate('Password/reset_email.txt',['url' => $url]);
            $html = View::getTemplate('Password/reset_email.html',['url' => $url]);;

            Mail::send($this->email,'Password reset',$text,$html);
        }

        public static function findByPasswordReset($token){

            $token = new Token($token);
            $hashed_token = $token->getHash();

            $sql = 'SELECT * FROM users WHERE password_reset_hash = :token_hash';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':token_hash',$hashed_token,PDO::PARAM_STR);

            $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
            $stmt ->execute();
            $user = $stmt->fetch();

            if($user){

                if(strtotime($user->password_reset_expires_at) > time()){

                    return $user; 
                }
            } 

        }
        public function resetPassword($password){

            $this->password = $password;

            $this->validate();

            if(empty($this->errors)){

                $password_hash = password_hash($this->password, PASSWORD_DEFAULT);

                $sql = 'UPDATE users SET password_hash = :password_hash,
                                        password_reset_hash =  NULL,
                                        password_reset_expires_at = NULL
                                        WHERE id = :id';
                $db = static::getDB();
                $stmt = $db->prepare($sql);
                
                $stmt->bindValue(':id',$this->id,PDO::PARAM_INT);
                $stmt->bindvalue(':password_hash',$password_hash,PDO::PARAM_STR);

                return $stmt->execute();

            }

            return false;
        }

        public function sendActivationEmail(){

            $url='http://' . $_SERVER['HTTP_HOST'] . '/php-mvc-master/public/signup/activate/' . $this->activation_token;

            $text = View::getTemplate('Signup/activation_email.txt',['url' => $url]);
            $html = View::getTemplate('Signup/activation_email.html',['url' => $url]);;

            Mail::send($this->email,'Account Activation',$text,$html);
        }
        public static function activate($value){

            $token = new Token($value);

            $hashed_token = $token->getHash(); 

            $sql = 'UPDATE users SET is_active = 1,
                                    activation_hash = null
                                    WHERE activation_hash = :hashed_token';
            
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':hashed_token', $hashed_token, PDO::PARAM_STR);

            $stmt->execute();
        }

        public function updateProfile($data){

            $this->name = $data['name'];
            $this->email = $data['email'];
            if($data['password'] != ''){
            $this->password = $data['password'];}

            $this->validate();

            if(empty($this->error)){

                $sql = 'UPDATE users SET name = :name,
                email = :email';
                if(isset($this->password)){
                    $sql .= ', password_hash = :password_hash';}
                $sql .= "\nWHERE id = :id";

                $db = static::getDB();
                $stmt = $db->prepare($sql);

                $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
                $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
                if(isset($this->password)){    
                $password_hash = password_hash($this->password,PASSWORD_DEFAULT);
                $stmt->bindValue(':password_hash',$password_hash,PDO::PARAM_STR);}
                return $stmt->execute();


            }
            return false;


        }
        public function addVehicalshop($data){

            return ImformationM::addVehicalshop($data,$this->id);

        }
        public function addVehical($data,$files){

            return ImformationM::addVehical($data,$files,$this->id);

        }


        public function addHotel($data,$files){

            return ImformationM::addHotel($data,$files,$this->id);

        }

        public function addShop($data,$files){

            return ImformationM::addShop($data,$files,$this->id);

        }

        public function addGuider($data){

            return ImformationM::addGuider($data,$this->id);

        }

        public static function returnUserID(){
            
            return $this->id;
        }

        public static function gethave($id){
  
            $sql = 'SELECT have FROM vehical WHERE user_id = :user_id';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);

            $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
            $stmt ->execute();
            $have = $stmt->fetch();

            if($have){

                return true;
            }


        }

        public static function addPlaceAction($data,$files){

            $name = ucwords($data['name']);
            $description = $data['description'];
            $file_array = $files['image'];
            
            $sql = 'INSERT INTO places (name,description) VALUES
                                    (:name,:description)';
            
            $db = static::getDB();
            $stmt = $db->prepare($sql);
    
    
    
            $stmt->bindValue(':name',$name,PDO::PARAM_STR);
            $stmt->bindValue(':description',$description,PDO::PARAM_STR);
     
    
            if($stmt->execute()){
                $last_id = $db->lastInsertId();
                $directoryName = '../Resource/Places/' . $last_id . '/';
                mkdir($directoryName, 0755, true);
                move_uploaded_file($file_array['tmp_name'],$directoryName.$last_id.".jpg");

                return true;
    
            }else{
    
                return false;
            }

        }

        public static function getPlaces(){
            $sql = 'SELECT * FROM places ';
            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());
            $stmt ->execute();
            $places = $stmt->fetchAll();

            if($places){

                return $places;
            }
        }



}
