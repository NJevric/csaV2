<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
// $code=400;

if(isset($_POST["idJSON"])){
    $id=$_POST['idJSON'];
    $queryPosition="SELECT * FROM client c INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position p ON p.id_position=cp.id_position WHERE c.id_client=$id";
    $resultPosition=executeQuery($queryPosition);
    $code=200;

    echo json_encode($resultPosition);
}
// else{
//     $error["errorMsgServer"]=["An error has occurred with server"];
//     $code=500;
// }




// http_response_code($code);

?>