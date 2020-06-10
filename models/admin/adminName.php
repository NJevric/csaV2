<?php

require_once("../config/connection.php");
$error["errorMsg"]=['An error has ocured, bad request'];
$code=400;
if(isset($_SESSION['admin'])){
    
    $idAdmin = $_SESSION['admin']->id_user;
    $queryAdmin="SELECT * FROM person p INNER JOIN user u ON p.id_person=u.id_person INNER JOIN person_img pi ON pi.id_person_img=p.id_person_img WHERE u.id_user=$idAdmin";
    try{
        if( $resultAdmin=executeOneRow($queryAdmin)){
            $code=200;
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

?>