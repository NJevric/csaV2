<?php

session_start();
header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

try{
    $queryCountry="SELECT * FROM country";
    $resultCountry=executeQuery($queryCountry);
    $code=200;
}
 
catch(PDOException $e){
    $code=500;
    $error=["errorMsg"=>$e->getMessage()];
    errorLog($e->getMessage());
}

echo json_encode($resultCountry);
http_response_code($code);

?>