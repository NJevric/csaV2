<?php

session_start();
header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['sort'])){

    $sortValue=$_POST['sort'];

    if($sortValue==0 || $sortValue==1){ 
        $queryNewsSort="SELECT * FROM news ORDER BY date DESC";
    }
    if($sortValue==2){
        $queryNewsSort="SELECT * FROM news ORDER BY date ASC";
    }
    
    try{
        $resultNewsSort = executeQuery($queryNewsSort);
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
}


echo json_encode($resultNewsSort);
http_response_code($code);



?>