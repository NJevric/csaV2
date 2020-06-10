<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST["clicked"])){

    $id=$_POST['clicked'];
    
    try{

        $queryDeleteNews = "DELETE FROM news WHERE id_news = ?";
        $resultDeleteNews=$conn->prepare($queryDeleteNews);
        
        if($resultDeleteNews->execute([$id])){
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
echo json_encode($error);
http_response_code($code);

?>