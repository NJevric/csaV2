<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['clicked'];
    $headline=$_POST['headline'];
    $text=$_POST['text'];

    try{

        $queryNewsUpdate="UPDATE news SET headline=?,text=? WHERE id_news=?";
        $resultNewsUpdate=$conn->prepare($queryNewsUpdate);
        
        if($resultNewsUpdate->execute([$headline,$text,$id])){
            $code=204;
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
echo json_encode($resultNewsUpdate);
// echo json_encode($error);
http_response_code($code);
?>