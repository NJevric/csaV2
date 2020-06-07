<?php


header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){
    $queryUser="SELECT * FROM person p INNER JOIN user u ON p.id_person=u.id_person INNER JOIN person_img pi ON pi.id_person_img=p.id_person_img INNER JOIN role r ON r.id_role=u.id_role";
    $resultUser=executeQuery($queryUser);
    $code=200;
}
else{
    $error["errorMsgServer"]=["An error has occurred with server"];
    $code=500;
}

echo json_encode($resultUser);
http_response_code($code);

?>