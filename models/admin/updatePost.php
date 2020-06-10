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
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
    
}
echo json_encode($resultNewsUpdate);
http_response_code($code);
?>