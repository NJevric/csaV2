<?php

require_once("../../config/connection.php");
    
    global $conn;
    // $queryClients = "SELECT * FROM person p INNER JOIN person_img pi ON p.id_person=pi.id_person INNER JOIN client c ON p.id_person=c.id_person INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position po ON po.id_position=cp.id_position";
    $queryClients = "SELECT * FROM person p INNER JOIN client c ON p.id_person=c.id_person INNER JOIN person_img pi ON pi.id_person=p.id_person";
    $resultClients = executeQuery($queryClients);
    // header('Content-Type: application/json');
    echo json_encode($resultClients);
   
   



?>