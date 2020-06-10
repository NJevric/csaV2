<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['clicked'];

    try{

        $queryNews="SELECT * FROM news WHERE id_news=?";
        $resultNews=$conn->prepare($queryNews);
        
        if($resultNews->execute([$id])){
            $code=200;
            $resultNews=$resultNews->fetch();
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
echo json_encode($resultNews);
http_response_code($code);
?>