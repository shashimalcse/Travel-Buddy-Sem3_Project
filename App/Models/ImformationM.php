<?php

namespace App\Models;

use PDO;
use \Core\View;

class ImformationM extends \Core\Model{


    public static function addVehicalshop($data,$id){

        $name = ucwords($data['name']);
        $address = $data['address'];
        $telephone = $data['telephone'];
        $lat = $data['shopLatitude'];
        $lng = $data['shopLongitude'];
        
        
        $sql = 'INSERT INTO vehical (user_id,name,address,telephone_number,have,lat,lng) VALUES
                                (:user_id,:name,:address,:telephone_number,:have,:lat,:lng)';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->bindValue(':address',$address,PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number',$telephone,PDO::PARAM_STR);
        $stmt->bindValue(':have','1',PDO::PARAM_STR);
        $stmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $stmt->bindValue(':lng',$lng,PDO::PARAM_STR);

        if($stmt->execute()){
            
            return true;

        }else{

            return false;
        }

    }
    public static function addVehical($data,$files,$id){

        $vehicaltype = $data['vehicaltype'];
        $vehicalmodel = $data['vehicalmodel'];
        if(isset($_POST['ac'])){
            $ac=$data['ac'];
        }
        else{
            $ac='No';
        }
        $cost=$data['cost'];
        $detail = $data['detail'];
        $photoArray=$files['userfile'];

        $sql = 'INSERT INTO vehical_list (user_id,vehical_type,vehical_model,ac,cost,detail)
                            VALUES (:user_id,:vehical_type,:vehical_model,:ac,:cost,:detail)';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':vehical_type',$vehicaltype,PDO::PARAM_STR);
        $stmt->bindValue(':vehical_model',$vehicalmodel,PDO::PARAM_STR);
        $stmt->bindValue(':ac',$ac,PDO::PARAM_STR);
        $stmt->bindValue(':cost',$cost,PDO::PARAM_STR);
        $stmt->bindValue(':detail',$detail,PDO::PARAM_STR);

        if($stmt->execute()){
            $last_id = $db->lastInsertId();
            $directoryName = '../Resource/' .$id. '/Vehicles/' . $last_id . '/';
            mkdir($directoryName, 0755, true);
            static::movePhotos($photoArray,$directoryName);
            
            return true;

        }else{

            return false;
        }


    }
    public static function addHotel($data,$files,$id){

        $name = ucwords($data['name']);
        $address = $data['address'];
        $telephone = $data['telephone'];
        $detail = $data['detail'];
        $lat = $data['shopLatitude'];
        $lng = $data['shopLongitude'];
        $photoArray = $files['userfile'];
        
        $sql = 'INSERT INTO hotel (user_id,name,address,telephone_number,detail,lat,lng) VALUES
                                (:user_id,:name,:address,:telephone_number,:detail,:lat,:lng)';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->bindValue(':address',$address,PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number',$telephone,PDO::PARAM_STR);
        $stmt->bindValue(':detail',$detail,PDO::PARAM_STR);
        $stmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $stmt->bindValue(':lng',$lng,PDO::PARAM_STR);

        if($stmt->execute()){
            $last_id = $db->lastInsertId();
            $directoryName = '../Resource/' .$id. '/Hotels/' . $last_id . '/';
            mkdir($directoryName, 0755, true);
            static::movePhotos($photoArray,$directoryName);
            
            return true;

        }else{

            return false;
        }

    }
    public static function addShop($data,$files,$id){

        $name = ucwords($data['name']);
        $address = $data['address'];
        $telephone = $data['telephone'];
        $shoptype = $data['shoptype'];
        
        $detail = $data['detail'];
        $lat = $data['shopLatitude'];
        $lng = $data['shopLongitude'];
        $photoArray = $files['userfile'];
        
        $sql = 'INSERT INTO shop (user_id,name,address,telephone_number,shop_type,detail,lat,lng) VALUES
                                (:user_id,:name,:address,:telephone_number,:shop_type,:detail,:lat,:lng)';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->bindValue(':address',$address,PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number',$telephone,PDO::PARAM_STR);
        $stmt->bindValue(':shop_type',$shoptype,PDO::PARAM_STR);

        $stmt->bindValue(':detail',$detail,PDO::PARAM_STR);
        $stmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $stmt->bindValue(':lng',$lng,PDO::PARAM_STR);

        if($stmt->execute()){
            $last_id = $db->lastInsertId();
            $directoryName = '../Resource/' .$id. '/Shop/' . $last_id . '/';
            mkdir($directoryName, 0755, true);
            static::movePhotos($photoArray,$directoryName);
            
            return true;

        }else{

            return false;
        }

    }
    public static function addGuider($data,$id){

        $name = ucwords($data['name']);
        $address = $data['address'];
        $telephone = $data['telephone'];
        $days = $data['days'];
        
        $detail = $data['detail'];
        $lat = $data['shopLatitude'];
        $lng = $data['shopLongitude'];
 
        
        $sql = 'INSERT INTO guider (user_id,name,address,telephone_number,days,detail,lat,lng) VALUES
                                (:user_id,:name,:address,:telephone_number,:days,:detail,:lat,:lng)';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $stmt->bindValue(':address',$address,PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number',$telephone,PDO::PARAM_STR);
        $stmt->bindValue(':days',$days,PDO::PARAM_STR);

        $stmt->bindValue(':detail',$detail,PDO::PARAM_STR);
        $stmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $stmt->bindValue(':lng',$lng,PDO::PARAM_STR);

        if($stmt->execute()){
          
            return true;

        }else{

            return false;
        }

    }
    public static function movePhotos($file_array,$directoryName){

        for($i=0;$i<count($file_array['name']);$i++){
            
            if(!$file_array['error'][$i]){

                move_uploaded_file($file_array['tmp_name'][$i],$directoryName.$file_array['name'][$i]);
                $imageName = $file_array['name'][$i];
                
            }
        }
    }

    public static function findByID($table,$id,$idtype){
        $sql='SELECT * FROM ' . $table . ' WHERE ' .$idtype. ' = :id';

        $db=static::getDB();
        $stmt=$db->prepare($sql);
        $stmt->bindValue(':id',$id,PDO::PARAM_INT);

        $stmt->setFetchMode(PDO::FETCH_CLASS,get_called_class());

        $stmt->execute();

        return $stmt->fetchAll();

    }

    public static function deleteByID($table,$id){
        
        $sql='DELETE FROM ' . $table . ' WHERE id = :id';

        $db=static::getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE,  
                          PDO::ERRMODE_EXCEPTION);
        $stmt=$db->prepare($sql);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();

    }
    public static function updateImformation($data,$table,$id){
        $db = static::getDB();

        $sql = 'UPDATE ' .$table. ' SET name = :name , 
                                          address = :address ,
                                          telephone_number = :telephone_number,
                                          detail = :detail WHERE id = :id ';
                                 
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
        $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number', $data['telephone'], PDO::PARAM_STR);
        $stmt->bindValue(':detail', $data['detail'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        

        return $stmt->execute();

                                        


}
public static function updateGuiderImformation($data,$table,$id){
    $db = static::getDB();

    $sql = 'UPDATE ' .$table. ' SET name = :name , 
                                      address = :address ,
                                      telephone_number = :telephone_number,
                                      days = :days ,
                                      detail = :detail WHERE id = :id ';
                             
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
    $stmt->bindValue(':address', $data['address'], PDO::PARAM_STR);
    $stmt->bindValue(':telephone_number', $data['telephone'], PDO::PARAM_STR);
    $stmt->bindValue(':days', $data['days'], PDO::PARAM_STR);
    $stmt->bindValue(':detail', $data['detail'], PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    

    return $stmt->execute();

                                    


}
}