<?php
//data for markers
//strategy is used here
ini_set('display_errors', 'On');
error_reporting(E_ALL);

class RetrieveData{
    private $Strategy;
    public function getData($user,$id)
    {
        return ($this->Strategy->getData($user,$id));
    }
    public function setStrategy($Str){
        $this->Strategy = $Str;
    }
}

Interface Strategy{
    public function getData($user,$id);    
}
//read comments
Class VehicleData implements Strategy{
    public function getData($user_id,$id){
        include_once 'dB.php';
        //change this line where part
        $sql = "SELECT * FROM vehical_list WHERE user_id = '$user_id'";
        $result = mysqli_query($conn,$sql);
        $details = array();
        while($row = mysqli_fetch_array($result)){
            
           
                //change the directory this is for HOTEL
                //use $row['id'] to identify vehicle
                $directory = '../../Resource/'.$user_id.'/Vehicles/'.$row["id"].'/';
                $files = scandir($directory);
                $img_files = array_slice($files, 2);
                $details[] = array(

                    'type'=>$row["vehical_type"],
                    'directory' => $directory,
                    'files'=>$img_files,
                    'details' => $row["detail"],
                    'model'=> $row["vehical_model"],
                    'ac'=>$row["ac"],
                    'cost'=>$row["cost"],
                    
                );
            
        };
        
        return json_encode($details);
        }
}

Class HotelData implements Strategy{
    public function getData($user_id,$id){
        include_once 'dB.php';
        $sql = "SELECT * FROM hotel where id='$id'";
        $result = mysqli_query($conn,$sql);
        $details = array();
        while($row = mysqli_fetch_array($result)){
            
            // if($id==$row["id"]){
                
                $directory = '../../Resource/'.$user_id.'/Hotels/'.$row["id"].'/';
                $files = scandir($directory);
                $img_files = array_slice($files, 2);
                $details[] = array(
                    'owner'=> $user_id,
                    'hotelName'=> $row["name"],
                    'address' => $row["address"],
                    'directory' => $directory,
                    'files'=>$img_files,
                    'telephone' => $row["telephone_number"],
                    'details'=> $row["detail"],     
                );
            // }
        };
        return json_encode($details);
    }
}
//change shop details
Class ShopData implements Strategy{
    public function getData($user_id,$id){
        include_once 'dB.php';
        $sql = "SELECT * FROM shop where id='$id'";
        $result = mysqli_query($conn,$sql);
        $details = array();
        while($row = mysqli_fetch_array($result)){
            
            // if($id==$row["id"]){
                
                $directory = '../../Resource/'.$user_id.'/Shop/'.$row["id"].'/';
                $files = scandir($directory);
                $img_files = array_slice($files, 2);
                $details[] = array(
                    'owner'=> $user_id,
                    'shopName'=> $row["name"],
                    'address' => $row["address"],
                    'directory' => $directory,
                    'files'=>$img_files,
                    'telephone' => $row["telephone_number"],
                    'details'=> $row["detail"],
                    'shopType'=>$row["shop_type"]     
                );
            // }
        };
        return json_encode($details);
    }
}

Class GuideData implements Strategy{
    public function getData($user_id,$id){
        include_once 'dB.php';
        $sql = "SELECT * FROM guider where user_id='$user_id'";
        $result = mysqli_query($conn,$sql);
        $details = array();
        while($row = mysqli_fetch_array($result)){
            
            // if($id==$row["id"]){
                
                //$directory = '../../Resource/'.$user_id.'/Shop/'.$row["id"].'/';
                //$files = scandir($directory);
                //$img_files = array_slice($files, 2);
                $details[] = array(
                    'owner'=> $user_id,
                    'name'=> $row["name"],
                    'address' => $row["address"],
                    'directory' => $directory,
                    //'files'=>$img_files,
                    'telephone' => $row["telephone_number"],
                    'details'=> $row["detail"],
                    'days'=>$row["days"]     
                );
            // }
        };
        return json_encode($details);
    }
}

//resource//userid//hotels/hotelid

$user_id = $_POST['user'];
$title = $_POST['title'];
$id = $_POST['id'];

// $user = 'iam groot';
// $title = 'vehiclerenter';
// $id = '37';


$retrieveData = new RetrieveData();

switch ($title) {
    case 'vehiclerenter':
        $retrieveData->setStrategy(new VehicleData());
        break;
    
    case 'hotel':
        $retrieveData->setStrategy(new HotelData());
        break;
    
    case 'shops':
        $retrieveData->setStrategy(new ShopData());
        break;
    
    case 'guide':
        $retrieveData->setStrategy(new GuideData());
        break;
}


echo($retrieveData->getData($user_id,$id));



?>
