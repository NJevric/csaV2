<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['clicked'];

    try{

        $queryUser="SELECT * FROM person p INNER JOIN user u ON p.id_person=u.id_person WHERE u.id_user=?";
        $resultUser=$conn->prepare($queryUser);
        
        if($resultUser->execute([$id])){
            $code=200;
            $resultUser=$resultUser->fetch();
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
echo json_encode($resultUser);
http_response_code($code);
?>