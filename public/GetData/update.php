<?php 

include_once 'dB.php';

$id = $_POST['id'];
$type = $_POST['type'];
$rate = $_POST['rate'];
$user_id = $_POST['user_id'];

switch ($type) {
    
    
    case 'hotel':
        
    $sql = "SELECT user_id FROM hotel_rating WHERE (user_id=$user_id) AND (hotel_id=$id)";
    $result = mysqli_query($conn,$sql);
    $details = array();

    if (mysqli_num_rows($result)==0){
        $sql = "INSERT INTO hotel_rating  (hotel_id, user_id, rating) VALUES ($id, $user_id, $rate)";
        if ($conn->query($sql) === TRUE) {
            $details[]=array(
                
                'status'=>'success'
            );
            
        } 
        else {
            $details[]=array(
                'status'=>"Error updating record: " . $conn->error
        );
    
        }
    }else{
        $details[]=array(
            'status'=>'already rated'
        );
    };

        break;


    
    case 'shops':
    $sql = "SELECT user_id FROM shop_rating WHERE (user_id=$user_id) AND (shop_id=$id)";
    $result = mysqli_query($conn,$sql);
    $details = array();
    
    
    if (mysqli_num_rows($result)==0){
        $sql = "INSERT INTO shop_rating  (shop_id, user_id, rating) VALUES ($id, $user_id, $rate)";
        if ($conn->query($sql) === TRUE) {
            $details[]=array(
                
                'status'=>'success'
            );
            
        } 
        else {
            $details[]=array(
                'status'=>"Error updating record: " . $conn->error
        );
    
        }
    }else{
        $details[]=array(
            'status'=>'already rated'
        );
    };
        break;
    
    case 'vehiclerenter':
        
    $sql = "SELECT user_id FROM vehicalshop_rating WHERE (user_id=$user_id) AND (vehicalshop_id=$id)";
    $result = mysqli_query($conn,$sql);
    $details = array();

    if (mysqli_num_rows($result)==0){
        $sql = "INSERT INTO vehicalshop_rating  (vehicalshop_id, user_id, rating) VALUES ($id, $user_id, $rate)";
        if ($conn->query($sql) === TRUE) {
            $details[]=array(
                'status'=>'success'
            );
            
        } 
        else {
            $details[]=array(
                'status'=>"Error updating record: " . $conn->error
        );
    
        }
    }else{
        $details[]=array(
            'status'=>'already rated'
        );
    };

        break;
    
}



echo (json_encode($details));


$conn->close();



?>