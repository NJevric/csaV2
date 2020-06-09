<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    // $country=$_POST['country'];
    $id=$_POST['clicked'];
    $team=$_POST['team'];
    // try{

        $queryTeamInsert="INSERT INTO client_club VALUES(NULL,?,?)";
        $resultTeamInsert=$conn->prepare($queryTeamInsert);
        
        if($resultTeamInsert->execute([$team,$id,$id])){
            $code=201;
        }
        else{
            $code=422;
        }
    // }
    // catch(PDOException $e){
    //     $error["errorMsgServer"]=["An error has occurred with server"];
    //     $code=500;
    // }
    
}

echo json_encode($resultTeamInsert);
// echo json_encode($error);
http_response_code($code);
?>