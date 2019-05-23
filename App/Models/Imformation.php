<?php

namespace App\Models;

use PDO;
use \Core\View;

class Imformation extends \Core\Model{


    public static function addVehical($data,$files,$id){

        $fullname = $data['fullname'];
        $address = $data['address'];
        $telephone = $data['telephone'];
        $vehicaltype = $data['vehicaltype'];
        $model = $data['model'];
        $detail = $data['vehicaldetails'];
        $lat = $data['shopLatitude'];
        $lng = $data['shopLongitude'];
        $photoArray = $files['userfile'];
        
        echo var_dump($photoArray);
        $sql = 'INSERT INTO vehical (user_id,fullname,address,telephone_number,vehical_type,vehical_model,detail,lat,lng) VALUES
                                (:user_id,:fullname,:address,:telephone_number,:vehical_type,:vehical_model,:detail,:lat,:lng)';
        
        $db = static::getDB();
        $stmt = $db->prepare($sql);


        $stmt->bindValue(':user_id',$id,PDO::PARAM_INT);
        $stmt->bindValue(':fullname',$fullname,PDO::PARAM_STR);
        $stmt->bindValue(':address',$address,PDO::PARAM_STR);
        $stmt->bindValue(':telephone_number',$telephone,PDO::PARAM_STR);
        $stmt->bindValue(':vehical_type',$vehicaltype,PDO::PARAM_STR);
        $stmt->bindValue(':vehical_model',$model,PDO::PARAM_STR);
        $stmt->bindValue(':detail',$detail,PDO::PARAM_STR);
        $stmt->bindValue(':lat',$lat,PDO::PARAM_STR);
        $stmt->bindValue(':lng',$lng,PDO::PARAM_STR);

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
    public static function movePhotos($file_array,$directoryName){

        for($i=0;$i<count($file_array['name']);$i++){
            
            if(!$file_array['error'][$i]){

                move_uploaded_file($file_array['tmp_name'][$i],$directoryName.$file_array['name'][$i]);
                $imageName = $file_array['name'][$i];
                
            }
        }
    }


}