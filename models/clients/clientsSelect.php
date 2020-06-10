<?php

session_start();
header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

try{
    $queryClients = "SELECT * FROM person p INNER JOIN client c ON p.id_person=c.id_person INNER JOIN person_img pi ON pi.id_person_img=p.id_person_img";
    $resultClients = executeQuery($queryClients);
    $code=200;
}

catch(PDOException $e){
    $code=500;
    $error=["errorMsg"=>$e->getMessage()];
    errorLog($e->getMessage());
}
echo json_encode($resultClients);
http_response_code($code);
   
   



?>