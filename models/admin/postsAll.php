<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $queryNews="SELECT * FROM news ORDER BY date DESC";

    try{
        $resultNews = executeQuery($queryNews);
        $code=200;
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