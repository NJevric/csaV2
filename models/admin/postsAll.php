<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){
    $queryNews="SELECT * FROM news n INNER JOIN news_date nd ON n.id_news_date=nd.id_news_date ORDER BY date DESC";
    $resultNews = executeQuery($queryNews);
    $code=200;
}
else{
    $error["errorMsgServer"]=["An error has occurred with server"];
    $code=500;
}

echo json_encode($resultNews);
http_response_code($code);

?>