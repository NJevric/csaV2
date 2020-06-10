<?php

if(isset($_POST['submit'])){

    header("Content-type: application/json");
    require_once("../../config/connection.php");
    $error["errorMsg"]=['An error has ocured, bad request'];
    $code=400;
    $queryFilterClients = "SELECT * FROM person p INNER JOIN person_img pi ON p.id_person_img=pi.id_person_img INNER JOIN client c ON p.id_person=c.id_person INNER JOIN active a ON a.id_active=c.id_active INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position po ON po.id_position=cp.id_position";
    
    try{
        if(isset($_POST['active']) && $_POST['active']!=0){
            $active=$_POST['active'];
        
            if(strpos($queryFilterClients,"WHERE")){
                $queryFilterClients.=" AND a.id_active=$active";
            }
            else{
                $queryFilterClients.=" WHERE a.id_active=$active";
            }
        }

        if(isset($_POST['position']) && count($_POST['position'])!=0 && !in_array(0,$_POST['position'])){

            $position=$_POST['position'];
            $positionString= implode(" , ",$position);

            if(strpos($queryFilterClients,"WHERE")){
                $queryFilterClients.=" AND po.id_position IN ($positionString)";
            }
            else{
                $queryFilterClients.=" WHERE po.id_position IN ($positionString)";
            }
        
        }
        
        $code=200;
        $resultFilterClients = executeQuery($queryFilterClients);

    }

    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
    echo json_encode($resultFilterClients);
    http_response_code($code);

}

?>