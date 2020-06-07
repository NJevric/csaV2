<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST["clicked"])){

    $id=$_POST['clicked'];
    
    try{

        $queryDeleteClient = "DELETE p,c FROM person p INNER JOIN client c ON c.id_person=p.id_person WHERE c.id_client = ?";
        $resultDeleteClient=$conn->prepare($queryDeleteClient);
        
        if($resultDeleteClient->execute([$id])){
            $code=204;
        }
        else{
            $code=422;
        }
    }
    catch(PDOException $e){
        $error["errorMsgServer"]=["An error has occurred with server"];
        $code=500;
    }
    
}
echo json_encode($error);
http_response_code($code);
// $queryDeleteClient = "DELETE p,c,pc,cp,cc FROM person p INNER JOIN client c ON c.id_person=p.id_person INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN client_club cc ON c.id_client=cc.id_client  WHERE c.id_client = ?";
// $resultDeleteClient=$conn->prepare($queryDeleteClient);
?>
