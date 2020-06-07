<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST["clicked"])){

    $id=$_POST['clicked'];
    
    try{
        // $queryDeleteUser="DELETE FROM user WHERE id_user=?";
        // $queryDeletePerson="DELETE FROM person WHERE id_person = (SELECT id_person FROM user WHERE id_user = ?)";
        // // $queryDeleteImg="DELETE FROM person_img WHERE id_person = (SELECT id_person FROM user WHERE id_user = ?)";
        // $resultDeleteUser=$conn->prepare($queryDeleteUser);
        // $resultDeletePerson=$conn->prepare($queryDeletePerson);
        // $resultDeleteImg=$conn->prepare($queryDeleteImg);

        $queryDeleteUser = "DELETE u,p FROM user u INNER JOIN person p ON u.id_person=p.id_person WHERE id_user = ?";
        $resultDeleteUser=$conn->prepare($queryDeleteUser);
        
        if($resultDeleteUser->execute([$id])){
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
// INNER JOIN person_img pi ON pi.id_person_img=p.id_person_img 
// && $resultDeletePerson->execute([$id])
echo json_encode($error);
http_response_code($code);

?>