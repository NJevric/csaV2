<?php


require_once("../config/connection.php");

if(isset($_SESSION['admin'])){
    $idAdmin = $_SESSION['admin']->id_user;
    $queryAdmin="SELECT * FROM person p INNER JOIN user u ON p.id_person=u.id_person INNER JOIN person_img pi ON pi.id_person_img=p.id_person_img WHERE u.id_user=$idAdmin";
    $resultAdmin=executeOneRow($queryAdmin);
}

?>