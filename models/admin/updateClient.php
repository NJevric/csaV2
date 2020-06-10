<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $id=$_POST['idClient'];
    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $dob=$_POST['dob'];
    $active=$_POST['active'];
    // $contract=$_POST['contract'];
    // $team=$_POST['team'];

    if(isset($_FILES['clientImg']) && !empty($_FILES['clientImg'])){

        $clientImg=$_FILES['clientImg'];

        $location = $_SERVER['DOCUMENT_ROOT'].'/csa-beta/assets/img/';
        $fileName = $_FILES['clientImg']['name'];
        $tmpName = $_FILES['clientImg']['tmp_name'];
        $fileSize = $_FILES['clientImg']['size'];
        $fileType = $_FILES['clientImg']['type'];

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
    }
    
    try{
        $queryUpdateClient="UPDATE person p INNER JOIN client c ON p.id_person=c.id_person  INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN active a ON a.id_active=c.id_active SET p.name=?,p.last_name=?,p.id_person_img=?,c.height=?,c.weight=?,c.dob=?,c.id_active=? WHERE c.id_client=?";
        $resultUpdateClient=$conn->prepare($queryUpdateClient);
        
        if($resultInsertImg){
            if($resultUpdateClient->execute([$firstName,$lastName,$idImg,$height,$weight,$dob,$active,$id])){
                $code=204;
            }
            else{
                $code=422;
            }
        }
        else{
            
            $queryUpdateClientNoImg="UPDATE person p INNER JOIN client c ON p.id_person=c.id_person  INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN active a ON a.id_active=c.id_active SET p.name=?,p.last_name=?,c.height=?,c.weight=?,c.dob=?,c.id_active=? WHERE c.id_client=?";
            $resultUpdateClientNoImg=$conn->prepare($queryUpdateClientNoImg);
            if($resultUpdateClientNoImg->execute([$firstName,$lastName,$height,$weight,$dob,$active,$id])){
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
$niz=[$resultInsertImg,$resultUpdateClient,$queryUpdateClientNoImg];

echo json_encode($niz);
http_response_code($code);
?>