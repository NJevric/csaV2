<?php

header("Content-type: application/json");
require_once("../../config/connection.php");
// $error["errorMsg"]=['An error has ocured, bad request'];
$code=400;

if(isset($_POST['clicked'])){

    $firstName=$_POST['firstName'];
    $lastName=$_POST['lastName'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $passport1=$_POST['passport1'];
    $passport2=$_POST['passport2'];
    $dob=$_POST['dob'];
    $active=$_POST['active'];
    $contract=$_POST['contract'];
    $team=$_POST['team'];
    $position1=$_POST['position1'];
    $position2=$_POST['position2'];
    $clientImg=$_FILES['clientImg'];

    if(isset($_FILES['clientImg']) && !empty($_FILES['clientImg'])){

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
        // move_uploaded_file($tmpName, $location.$fileName);
    }
    try{
        $queryPersonInsert="INSERT INTO person VALUES(NULL,?,?,?)";
        $resultPersonInsert=$conn->prepare($queryPersonInsert);

        if($resultPersonInsert->execute([$firstName,$lastName,$idImg])){
            $code=201;
            $idPerson=$conn->lastInsertId();
        }
        else{
            $code=422;
        }
        
        if($resultPersonInsert){
            $queryClientInsert = "INSERT INTO client VALUES(NULL,?,?,?,?,?)";
            $resultClientInsert=$conn->prepare($queryClientInsert);

            if($resultClientInsert->execute([$height,$weight,$dob,$active,$idPerson])){
                $code=201;
                $idClient=$conn->lastInsertId();
            }
            else{
                $code=422;
            }
        }
        if($resultClientInsert){

            $queryClientPosition = "INSERT INTO client_position VALUES(NULL,?,?)";
            $resultClientPosition=$conn->prepare($queryClientPosition);

            $queryClientPosition2 = "INSERT INTO client_position VALUES(NULL,?,?)";
            $resultClientPosition2=$conn->prepare($queryClientPosition2);

            $queryClientPassport = "INSERT INTO passport_client VALUES(NULL,?,?)";
            $resultClientPassport = $conn->prepare($queryClientPassport);

            $queryClientPassport2 = "INSERT INTO passport_client VALUES(NULL,?,?)";
            $resultClientPassport2 = $conn->prepare($queryClientPassport2);

            $queryClientClub = "INSERT INTO client_club VALUES(NULL,?,?,?)";
            $resultClientClub = $conn->prepare($queryClientClub);

            if($position1!=0){
                $resultClientPosition->execute([$idClient,$position1]);
                $code=201;
            }
            if($position2!=0){
                $resultClientPosition2->execute([$idClient,$position2]);
                $code=201;
            }

            if($passport1!=0){
                $resultClientPassport->execute([$idClient,$passport1]);
                $code=201;
            }
            if($passport2!=0){
                $resultClientPassport2->execute([$idClient,$passport2]);
                $code=201;
            }

            if($resultClientClub->execute([$contract,$team,$idClient])){
                $code=201;
            }


            else{
                $code=422;
            }
        }
        
        
    }
    catch(PDOException $e){
        $error["errorMsgServer"]=["An error has occurred with server"];
        $code=500;
    }
    
}
$niz=[$resultInsertImg,$resultPersonInsert,$resultClientInsert,$resultClientPosition,$resultClientPassport];
echo json_encode($niz);
// echo json_encode($error);
http_response_code($code);
?>