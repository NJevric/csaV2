<?php
session_start();
header("Content-type: application/json");
require_once("../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;
if(isset($_POST['clicked'])){
    
    $firstName=$_POST['firstNameJSON'];
    $lastName=$_POST['lastNameJSON'];
    $emailRegister = $_POST['emailJSON'];
    $passRegister = $_POST['passJSON'];
    
    
    if(!preg_match("/^[A-Z][a-z]{2,15}$/", $firstName)){
        if($firstName==""){
            $error["errorFistName"]="First Name field is mandatory";
            $code=422;
        }
        else{
            $error["errorFistName"]="Invalid first name format (Fist letter must be uppercase)";
            $code=422;
        }
    }
    if(!preg_match("/^[A-Z][a-z]{2,15}$/", $lastName)){
        if($lastName==""){
            $error["errorLastName"]="Last Name field is mandatory";
            $code=422;
        }
        else{
            $error["errorLastName"]="Invalid last name format (Fist letter must be uppercase)";
            $code=422;
        }

    }
    if(!filter_var($emailRegister, FILTER_VALIDATE_EMAIL)){
        if($emailRegister==""){
            $error["errorEmail"]="Email field is mandatory";
            $code=422;
        }
        else{
             $error["errorEmail"]="Invalid email format";
                $code=422;
        }
       
    }
    if(!preg_match("/^.{5,60}$/", $passRegister)){
        if($passRegister){
            $error["errorPass"]="Password field is mandatory";
            $code=422;
        }
        else{
            $error["errorPass"]="Invalid password format (Min 5, Max 60 characters)";
            $code=422;
        }
      
    }
    if($code!=422){ 

        $queryRegister="INSERT INTO person VALUES(NULL,?,?)";
        $resultRegister=$conn->prepare($queryRegister);
        
        try{

            $resultRegister->execute([$firstName,$lastName]);
            $pass=md5($passRegister);
            $role=1;
            $idPerson=$conn->lastInsertId();   

            if($resultRegister){
                $queryRegisterUser="INSERT INTO user VALUES(NULL,?,?,now(),$role,$idPerson)";
                $resultRegisterUser=$conn->prepare($queryRegisterUser);
                $resultRegisterUser->execute([$emailRegister,$pass]);
            }
            $_SESSION['success']="Successful registration, log in to access the site";
            $code=200;      
        }
        catch(PDOException $e){
            $code=500;
            $error["errorMsg"]=["An error has ocured with server"];
        }
    }
}
// echo json_encode($success);
echo json_encode($error);
http_response_code($code);
?>