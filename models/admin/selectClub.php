<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$queryPosition="SELECT * FROM club";
$resultPosition=executeQuery($queryPosition);
echo json_encode($resultPosition);

?>