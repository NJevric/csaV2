<?php

require_once("../../config/connection.php");
global $conn;
$queryNews="SELECT * FROM news n INNER JOIN news_date nd ON n.id_news_date=nd.id_news_date";
$resultNews = executeQuery($queryNews);
echo json_encode($resultNews);

?>