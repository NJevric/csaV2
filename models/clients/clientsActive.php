<?php
header("Content-type: application/json");
require_once("../../config/connection.php");
 $queryActive="SELECT * FROM active";
 $resultActive=executeQuery($queryActive);
 echo json_encode($resultActive);


 
?>