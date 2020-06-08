<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$queryPosition="SELECT * FROM position";
$resultPosition=executeQuery($queryPosition);
echo json_encode($resultPosition);

?>