<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['clicked'];

    try{

        $queryClient="SELECT * FROM person p INNER JOIN client c ON p.id_person=c.id_person INNER JOIN  passport_client pc ON c.id_client=pc.id_client INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN client_club cc ON c.id_client=cc.id_client INNER JOIN active a ON c.id_active=a.id_active WHERE c.id_client=?";
        $resultClient=$conn->prepare($queryClient);
        
        if($resultClient->execute([$id])){
            $code=200;
            $resultClient=$resultClient->fetch();
        }
        else{
            $code=422;
        }
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
    
}

echo json_encode($resultClient);
http_response_code($code);
?>