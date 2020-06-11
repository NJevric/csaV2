<?php

session_start();
require_once("../../config/connection.php");
require_once("../../functions.php");
header("Content-type: application/json");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){
    
    try{
        deleteLogin($_SESSION['admin']->id_user);
        unset($_SESSION['admin']);
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
}
    
http_response_code($code);
echo json_encode($error);
?>