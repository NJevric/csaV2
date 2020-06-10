<?php
session_start();
header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){
    $name=$_POST['nameJSON'];
    $subject=$_POST['subjectJSON'];
    $email=$_POST['emailJSON'];
    $text=$_POST['textJSON'];

    if(!preg_match("/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/", $name)){
        $error["errorName"]="Enter valid name format";
        $code = 422;
    }
    if(!preg_match("/^[a-zA-Z]+$/", $subject)){
        $error["errorSubject"]="Enter valid subject format";
        $code = 422;
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error["errorEmail"]="Enter valid email format";
        $code = 422;
    }
    if(strlen($text)<10){
        $error["errorText"]="Message must contain min 10 characters";
        $code = 422;
    }
    if(strlen($text)>200){
        $error["errorText"]="Message can contain max 200 characters";
        $code = 422;
    }
    try{

       if($code!=422){
            $adresaprimaoca='njevric9@gmail.com,jevra997@gmail.com';
            $naslov='Message from Csa website';
            $sadrzajMail='From: ' .$name. "\n" . 'Subject: ' . $subject . "\n" . 'Email :' .$email. "\n" . "Content: \n".$text;
            $dolazniSajt='From:csasportsmanagement.com';
            mail($adresaprimaoca,$naslov,$sadrzajMail,$dolazniSajt);
            $code=200; 
       }
        
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
}
echo json_encode($error);
http_response_code($code);



?>