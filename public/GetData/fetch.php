<?php 
//can use local storage to save data
include_once 'dB.php';
$id = $_POST['id'];
$type = $_POST['type'];


switch ($type) {
    
    case 'hotel':
    $sql = "SELECT rating FROM hotel_rating where hotel_id='$id'";
    $result = mysqli_query($conn,$sql);
    $details = array();
    $rate=0;
    $rows = mysqli_num_rows($result);
    
        while($row = mysqli_fetch_array($result)){
                $rate+= $row['rating'];        
        };
    
    
    
    if($rows==0){
        $details[]=array(
            'rate'=>'no ratings',
        );
    }
    else{
        $details[]=array(
            'rate'=>round($rate/$rows,2),
        );
    }
    




        break;
    
    case 'shops':
        
    $sql = "SELECT rating FROM shop_rating where shop_id='$id'";
    $result = mysqli_query($conn,$sql);
    $details = array();
    $rate=0;
    $rows = mysqli_num_rows($result);
    
        while($row = mysqli_fetch_array($result)){
                $rate+= $row['rating'];        
        };
    
    
    
    if($rows==0){
        $details[]=array(
            'rate'=>'no ratings',
        );
    }
    else{
        $details[]=array(
            'rate'=>round($rate/$rows,2),
        );
    }


        break;

        case 'vehiclerenter':
        $sql = "SELECT rating FROM vehicalshop_rating where vehicalshop_id='$id'";
        $result = mysqli_query($conn,$sql);
        $details = array();
        $rate=0;
        $rows = mysqli_num_rows($result);
        
            while($row = mysqli_fetch_array($result)){
                    $rate+= $row['rating'];        
            };
        
        
        
        if($rows==0){
            $details[]=array(
                'rate'=>'no ratings',
            );
        }
        else{
            $details[]=array(
                'rate'=>round($rate/$rows,2),
            );
        }
        
    
    
    
    
            break;
    
}



echo (json_encode($details));


?>