<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST["clicked"])){

    $queryClient="SELECT c.id_client, pe.name AS first_name,pe.last_name,c.dob,a.free_agent,pimg.src,pimg.alt FROM client c INNER JOIN active a ON a.id_active=c.id_active INNER JOIN person pe ON pe.id_person=c.id_person INNER JOIN person_img pimg ON pe.id_person_img=pimg.id_person_img";
   
    try{
        $resultClient=executeQuery($queryClient);
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
}

echo json_encode($resultClient);
http_response_code($code);

?>