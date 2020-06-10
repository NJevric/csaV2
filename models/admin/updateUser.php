<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['id'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $email=$_POST['email'];
    

    if(isset($_FILES['userImg']) && !empty($_FILES['userImg'])){

        $userImg=$_FILES['userImg'];

        $location = $_SERVER['DOCUMENT_ROOT'].'/csa-beta/assets/img/';
        $fileName = $_FILES['userImg']['name'];
        $tmpName = $_FILES['userImg']['tmp_name'];
        $fileSize = $_FILES['userImg']['size'];
        $fileType = $_FILES['userImg']['type'];

        list($sirina, $visina) = getimagesize($tmpName);
        $proc=0.55;
        $novaSirina=$sirina*$proc;
        $novaVisina=$visina*$proc;
    
        if($fileType=="image/jpg") {
            $postojecaSlika = imagecreatefromjpeg($tmpName);
        }
        else if($fileType == "image/jpeg"){
            $postojecaSlika = imagecreatefromjpeg($tmpName);
        }
        else if($fileType == "image/png"){
            $postojecaSlika = imagecreatefrompng($tmpName);
        }
    
        $prazna_image = imagecreatetruecolor($novaSirina,$novaVisina);
        imagecopyresampled($prazna_image, $postojecaSlika, 0,0,0,0, $novaSirina,$novaVisina,$sirina,$visina);
        $novaSlika = $prazna_image;
    
        $compression=100;
        if($fileType=="image/jpg"){
            imagejpeg($novaSlika,$location.$fileName,$compression);
           
        }
        else if($fileType == "image/jpeg"){
            imagejpeg($novaSlika,$location.$fileName,$compression);
        }
        else if($fileType == "image/png"){
            imagepng($novaSlika,$location.$fileName,$compression);
        }

        $queryInsertImg = "INSERT INTO person_img VALUES(NULL,?,?)";
        $resultInsertImg=$conn->prepare($queryInsertImg);

        if($resultInsertImg->execute(["assets/img/".$fileName,$fileName])){
            $code=201;
            $idImg=$conn->lastInsertId(); 
        }
        else{
            $code=422;
        }
        // move_uploaded_file($tmpName, $location.$fileName);
    }
    try{
        $queryUpdateUser="UPDATE person p INNER JOIN user u ON p.id_person=u.id_person SET p.name=?,p.last_name=?,p.id_person_img=?,u.email=? WHERE u.id_user=?";
        $resultUpdateUser=$conn->prepare($queryUpdateUser);
        
        if($resultInsertImg){
            if($resultUpdateUser->execute([$firstName,$lastName,$idImg,$email,$id])){
                $code=204;
            }
            else{
                $code=422;
            }
        }
        else{
            $queryUpdateUserNoImg="UPDATE person p INNER JOIN user u ON p.id_person=u.id_person SET p.name=?,p.last_name=?,u.email=? WHERE u.id_user=?";
            $resultUpdateUserNoImg=$conn->prepare($queryUpdateUserNoImg);
            if($resultUpdateUserNoImg->execute([$firstName,$lastName,$email,$id])){
                $code=204;
            }
            else{
                $code=422;
            }
        }
        
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
    
}
$niz=[$resultInsertImg,$resultUpdateUser,$resultUpdateUserNoImg];
echo json_encode($niz);
http_response_code($code);
?>