<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST["clicked"])){
    $queryClient="SELECT pe.name AS first_name,pe.last_name,c.height,c.weight,c.dob,a.free_agent,p.name_position AS position,pimg.src,pimg.alt,co.name AS country,cc.dateContract,cl.name FROM client c INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN country co ON pc.id_country=co.id_country INNER JOIN client_club cc ON c.id_client=cc.id_client INNER JOIN club cl ON cc.id_club=cl.id_club INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position p ON cp.id_position=p.id_position INNER JOIN active a ON a.id_active=c.id_active INNER JOIN person pe ON pe.id_person=c.id_person INNER JOIN person_img pimg ON pe.id_person=pimg.id_person";
    $resultClient=executeQuery($queryClient);
    $code=200;

}
else{
    $error["errorMsgServer"]=["An error has occurred with server"];
    $code=500;
}

// echo json_encode($error);
echo json_encode($resultClient);

http_response_code($code);

?>