<?php

if(isset($_POST['clicked'])){
    $name=$_POST['nameJSON'];
    $subject=$_POST['subjectJSON'];
    $email=$_POST['emailJSON'];
    $text=$_POST['textJSON'];

    $status = 200;

    $errors=[];

    if(!preg_match("/^[A-Z][a-z]{2,19}(\s[A-Z][a-z]{2,19})*$/", $name)){
        $greske[]="Enter valid name format";
    }
    if(!preg_match("/^[a-zA-Z]+$/", $subject)){
        $greske[]="Enter valid subject format";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $greske[]="Enter valid email format";
    }
    if(strlen($text)<10){
        $greske[]="Message must contain min 10 characters";
    }
    if(strlen($text)>200){
        $greske[]="Message can contain max 200 characters";
    }
    if(count($errors)){
        $_SESSION["errContact"]=$errors;
        header("Location: ../login.php");
    }
    
    http_response_code($status);
    echo json_encode("uspeh");
    $adresaprimaoca='njevric9@gmail.com,jevra997@gmail.com';
    $naslov='Message from Csa website';
    $sadrzajMail='From: ' .$name. "\n" . 'Subject: ' . $subject . "\n" . 'Email :' .$email. "\n" . "Content: \n".$text;
    $dolazniSajt='From:csasportsmanagement.com';
    mail($adresaprimaoca,$naslov,$sadrzajMail,$dolazniSajt);
    
    
}
else{
    echo "Cao hakeru";
}


?>