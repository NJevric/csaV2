<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $country=$_POST['country'];
 
    try{

        $queryPassInsert="INSERT INTO country VALUES(NULL,?)";
        $resultPassInsert=$conn->prepare($queryPassInsert);
        
        if($resultPassInsert->execute([$country])){
            $code=201;
        }
        else{
            $code=422;
        }
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
    
}
echo json_encode($resultPassInsert);
http_response_code($code);
?>