<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$queryPass="SELECT * FROM country";
$resultPass=executeQuery($queryPass);
echo json_encode($resultPass);

?>