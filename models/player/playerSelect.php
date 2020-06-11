<?php

if(isset($_GET['id'])){

    global $conn;
    $idPlayer=$_GET['id'];

    try{
        $queryClient="SELECT pe.name AS first_name,pe.last_name,c.height,c.weight,c.dob,a.free_agent,p.name_position AS position,pimg.src,pimg.alt,co.name AS country,cc.dateContract,cl.name FROM client c INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN country co ON pc.id_country=co.id_country INNER JOIN client_club cc ON c.id_client=cc.id_client INNER JOIN club cl ON cc.id_club=cl.id_club INNER JOIN client_position cp ON c.id_client=cp.id_client INNER JOIN position p ON cp.id_position=p.id_position INNER JOIN active a ON a.id_active=c.id_active INNER JOIN person pe ON pe.id_person=c.id_person INNER JOIN person_img pimg ON pe.id_person_img=pimg.id_person_img WHERE c.id_client=$idPlayer";
        $resultClient=executeOneRow($queryClient);
    
        // IGRAC JE AKTIVAN I IMA VISE TIMOVA NA SVOJE IME (PRIKAZ TRENUTNOG TIMA)
        $queryCurrentTeam="SELECT cc.dateContract,cl.name FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client INNER JOIN active a ON a.id_active=c.id_active WHERE c.id_client=$idPlayer AND a.free_agent=1 ORDER BY cc.dateContract DESC LIMIT 1 ";
        $resultCurrentTeam=executeOneRow($queryCurrentTeam);
    
        // IGRAC JE AKTIVAN I IMA VISE TIMOVA NA SVOJE IME (PRIKAZ PRETHODNIH TIMOVA)
        $queryPreviousTeam="SELECT cc.dateContract,cl.name FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client INNER JOIN active a ON a.id_active=c.id_active WHERE c.id_client=$idPlayer AND a.free_agent=1 ORDER BY cc.dateContract DESC LIMIT 1,4 ";
        $resultPreviousTeam=executeQuery($queryPreviousTeam);
        
        $queryNumOfTeams="SELECT COUNT(cc.dateContract) AS broj FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client WHERE c.id_client=$idPlayer";
        $resultNumOfTeams=executeOneRow($queryNumOfTeams);
        // var_dump($resultNumOfTeams);
        $brojKolonaTimovi = intval($resultNumOfTeams->broj);
    
            // IGRAC JE AKTIVAN I IMA JEDAN TIM NA SVOJE IME (PRIKAZ TRENUTNOG TIMA)
            $queryTeamActive1="SELECT cc.dateContract,cl.name,a.free_agent FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client INNER JOIN active a ON a.id_active=c.id_active WHERE c.id_client=$idPlayer AND a.free_agent=1 ORDER BY cc.dateContract DESC LIMIT 0,1";
    
            // IGRAC NIJEJE AKTIVAN I IMA JEDAN TIM NA SVOJE IME (PRIKAZ pRETHODNOG TIMA)
            $queryTeamActive0="SELECT cc.dateContract,cl.name,a.free_agent FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client INNER JOIN active a ON a.id_active=c.id_active WHERE c.id_client=$idPlayer AND a.free_agent=0 ORDER BY cc.dateContract DESC LIMIT 0,1";
    
            $resultTeamActive1=executeOneRow($queryTeamActive1);
            $resultTeamActive0=executeOneRow($queryTeamActive0);
            // echo $resultTeamActive0->free_agent;
        
        // IGRAC NIJE AKTIVAN A IGRAO JE ZA VISE TIMOVA (PRIKAZ PRETHODNIH TIMOVA)
        $queryPreviousTeamActive0="SELECT cc.dateContract,cl.name,a.free_agent FROM client_club cc INNER JOIN club cl ON cl.id_club=cc.id_club INNER JOIN client c ON c.id_client=cc.id_client INNER JOIN active a ON a.id_active=c.id_active WHERE c.id_client=$idPlayer AND a.free_agent=0 ORDER BY cc.dateContract DESC LIMIT 0,4 ";
        $resultPreviousTeamActive0=executeQuery($queryPreviousTeamActive0);
       
    
        // pozicija klijenta
    
        $queryPosition = "SELECT p.name_position AS posName FROM position p INNER JOIN client_position cp ON p.id_position=cp.id_position INNER JOIN client c ON c.id_client=cp.id_client WHERE c.id_client=$idPlayer";
        $resultPosition = executeQuery($queryPosition);
    
        $queryNumPosition = "SELECT COUNT(p.name_position) AS numPos FROM position p INNER JOIN client_position cp ON p.id_position=cp.id_position INNER JOIN client c ON c.id_client=cp.id_client WHERE c.id_client=$idPlayer";
        $resultNumPosition = executeOneRow($queryNumPosition);
        
    
        // pasos klijenta
    
        $queryPassport = "SELECT co.name AS country FROM client c INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN country co ON co.id_country=pc.id_country WHERE c.id_client=$idPlayer";
        $resultPassport=executeQuery($queryPassport);
    
        $queryCountPassport = "SELECT COUNT(co.name) AS numCountry FROM client c INNER JOIN passport_client pc ON c.id_client=pc.id_client INNER JOIN country co ON co.id_country=pc.id_country WHERE c.id_client=$idPlayer";
        $resultCountPassport=executeOneRow($queryCountPassport);
        // var_dump($resultCountPassport);
        $code=200;
    }
    catch(PDOException $e){
        $code=500;
        $error=["errorMsg"=>$e->getMessage()];
        errorLog($e->getMessage());
    }
}
?>