<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['idClient'];
    $team=$_POST['team'];
    $contract=$_POST['contract'];

    try{
        
        $queryTeamInsert="INSERT INTO client_club VALUES(NULL,?,?,?)";
        $resultTeamInsert=$conn->prepare($queryTeamInsert);
        
        if($resultTeamInsert->execute([$contract,$team,$id])){
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

echo json_encode($resultTeamInsert);
http_response_code($code);
?>