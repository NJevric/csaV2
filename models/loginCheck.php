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

            $queryLogin="SELECT * from person p INNER JOIN user u ON p.id_person=u.id_person INNER JOIN role r on u.id_role=r.id_role where email=? and password=?";
            $resultLogin=$conn->prepare($queryLogin);
            $password=md5($pass);
            
            $queryPass = "SELECT password FROM user WHERE password=?";
            $resultPass=$conn->prepare($queryPass);
            
            try{
                
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

           
                $resultLogin->execute([$email,$password]);
                if($resultLogin->rowCount()==1){
                    $user=$resultLogin->fetch(); 
                    $_SESSION['admin']=$user;  
                    $code=200;      
                }
                
            }
            catch(PDOException $e){
                $code=500;
                $error["errMsg"]=["An error has ocured with server"];
            }
        } 
    }
  
    echo json_encode($error);
    http_response_code($code);
?>