<?php

if(isset($_GET['id'])){
    global $conn;
    $idPlayer=$_GET['id'];

    $queryClient="SELECT pe.name AS first_name,pe.last_name,c.height,c.weight,c.age,a.free_agent,p.name AS position,ci.src,ci.alt,co.name AS country,cc.dateContract,cl.name FROM client c INNER JOIN client_img ci ON ci.id_client=c.id_client INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN country co ON pc.id_country=co.id_country INNER JOIN client_club cc ON c.id_client=cc.id_client INNER JOIN club cl ON cc.id_club=cl.id_club INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position p ON cp.id_position=cp.id_position INNER JOIN active a ON a.id_active=c.id_active INNER JOIN person pe ON pe.id_person=c.id_person WHERE c.id_client=$idPlayer";
    $resultClient=executeOneRow($queryClient);

    $queryCurrentTeam="SELECT cc.dateContract,cl.name FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client WHERE c.id_client=$idPlayer ORDER BY cc.dateContract DESC LIMIT 1 ";
    $resultCurrentTeam=executeOneRow($queryCurrentTeam);

    $queryPreviousTeam="SELECT cc.dateContract,cl.name FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client WHERE c.id_client=$idPlayer ORDER BY cc.dateContract DESC LIMIT 1,4 ";
    $resultPreviousTeam=executeQuery($queryPreviousTeam);
    
    $queryNumOfTeams="SELECT COUNT(cc.dateContract) AS broj FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client WHERE c.id_client=$idPlayer";
    $resultNumOfTeams=executeOneRow($queryNumOfTeams);
    // var_dump($resultNumOfTeams);
    $brojKolonaTimovi = intval($resultNumOfTeams->broj);
    if($brojKolonaTimovi==1){
        $queryPreviousTeam1="SELECT cc.dateContract,cl.name FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client WHERE c.id_client=$idPlayer ORDER BY cc.dateContract DESC LIMIT 0,4 ";
    $resultPreviousTeam1=executeQuery($queryPreviousTeam1);
    
    }
    
}


?>