<?php
session_start();
header("Content-type: application/json");

$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;
if(isset($_POST['clicked'])){
    
    unset($_SESSION['admin']);
    session_destroy();
    $code=200;
}
else{
    $code=500;
    $error["errorMsg"]=["An error has occurred with server"];
}  
    
http_response_code($code);
echo json_encode($error);
?>