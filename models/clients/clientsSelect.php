<?php

require_once "../../config/connection.php";
    
    global $conn;
    $queryClients = "SELECT * FROM person p INNER JOIN client c ON p.id_person=c.id_person INNER JOIN client_img ci ON c.id_client=ci.id_client";
    $resultClients = executeQuery($queryClients);
    // header('Content-Type: application/json');
    echo json_encode($resultClients);
    foreach($resultClients as $i):?>
        <div class="client col-lg-3 col-md-3 col-6 text-center">
            <img class="" src="<?= $i->src ?>" alt="<?= $i->alt ?>">
            <h4 class="mt-3 mb-4 text-center">Jerell Springer</h4>
            <a href="#" class="clientBtn mt-3">INFO</a>
        </div>
        <?php endforeach;



?>