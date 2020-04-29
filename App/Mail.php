<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use App\Config;

class Mail{

    public static function send($to, $subject, $text,$html)
    {
        

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet="UTF-8";
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPDebug = 0;
        $mail->Username = 'shashimalsenarath97@gmail.com';
        $mail->Password = '1234Shashi@';
        $mail->SMTPAuth = true;
        
        $mail->From = 'shashimalsenarath97@gmail.com';
        $mail->FromName = 'shashimal';
        $mail->AddAddress($to);
       
        $mail->IsHTML(true);
        $mail->Subject    = $subject;
        $mail->AltBody    = $text;
        $mail->Body    = $html;

        if($mail->send()){
            echo 'mail sent';
        }
        else{
            echo 'fail';
        }

    
    }
}
