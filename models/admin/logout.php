<?php

session_start();
header("Content-type: application/json");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;


if(isset($_POST['clicked'])){
    
    try{
        unset($_SESSION['admin']);
        session_destroy();
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