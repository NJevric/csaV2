<?php
    session_start();
    header("Content-type: application/json");
    require_once("../config/connection.php");
    $error["errorMsg"]=['An error has ocured, bad request'];
    $code=400;
   

    if(isset($_POST["clicked"])){
        
        $email=$_POST["emailJSON"];
        $pass=$_POST["passJSON"];
    
        // $error=[];
    
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error["errorEmail"]="Invalid email format";
            $code=422;
        }
        if(!preg_match("/^.{5,60}$/", $pass)){
            $error["errorPass"]="Invalid password format";
            $code=422;
        }
    
        if($code!=422){

            $queryLogin="SELECT * from person p INNER JOIN user u ON p.id_person=u.id_person INNER JOIN role r on u.id_role=r.id_role where email=? and password=? and u.id_role=?";
            $idRole=3;
            $resultLogin=$conn->prepare($queryLogin);
            $password=md5($pass);
            
            $queryPass = "SELECT password FROM user WHERE password=?";
            $resultPass=$conn->prepare($queryPass);
               
            $queryEmail = "SELECT email FROM user WHERE email=?";
            $resultEmail=$conn->prepare($queryEmail);
          
            $queryRole = "SELECT id_role FROM user WHERE id_role IN (1,2) AND email=? and password=?";
            $resultRole = $conn->prepare($queryRole);

            try{
                
                $resultEmail->execute([$email]);
                if($resultEmail->rowCount()!=1){
                    $error["errorEmail"]="Wrong email, try again";
                    $code=422; 
                }

                $resultPass->execute([$password]);
                if($resultPass->rowCount()!=1){
                    $error["errorPass"]="Wrong password, try again";
                    $code=422;     

                    // $adresaprimaoca='njevric9@gmail.com';
                    // $naslov='Message from Csa Login';
                    // $sadrzajMail='Someone tried to login with your password';
                    // $dolazniSajt='From:csasportsmanagement.com';
                    // mail($adresaprimaoca,$naslov,$sadrzajMail,$dolazniSajt);
                }
               
                    $resultRole->execute([$email,$password]);
                    if($resultRole->rowCount()==1){
                        $code=201;  
                    }
                
                
           
                $resultLogin->execute([$email,$password,$idRole]);
                if($resultLogin->rowCount()==1){
                    $user=$resultLogin->fetch(); 
                    $_SESSION['admin']=$user;  
                    $code=200;      
                }
               
                
            }
            catch(PDOException $e){
                $code=500;
                $error=["errorMsg"=>$e->getMessage()];
                errorLog($e->getMessage());
            }
        } 
    }
  
    echo json_encode($error);
    http_response_code($code);
?>