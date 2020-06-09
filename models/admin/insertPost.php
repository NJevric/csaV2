<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $headline=$_POST['headline'];
    $date=$_POST['date'];
    $text=$_POST['text'];
 
    try{

        $queryNewsInsert="INSERT INTO news VALUES(NULL,?,?,?)";
        $resultNewsInsert=$conn->prepare($queryNewsInsert);
        
        if($resultNewsInsert->execute([$headline,$text,$date])){
            $code=201;
        }
        else{
            $code=422;
        }
    }
    catch(PDOException $e){
        $error["errorMsgServer"]=["An error has occurred with server"];
        $code=500;
    }
    
}
echo json_encode($resultNewsInsert);
// echo json_encode($error);
http_response_code($code);
?>