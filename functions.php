<?php

function pagesAll(){
 return
["Home","Services","Clients","News","Contact","Author"];
 }

function numOfPages(){
    return count(pagesAll());
}
 function pageVisit($dan){

    $niz=[];
    $ukupno=0;
    $home=0;
    $services=0;
    $clients=0;
    $news=0;
    $contact=0;
    // $author=0;

    $oneDayAgo=strtotime($dan);
    
    // $date = date('d-m-Y');
    // $prev_date = date('d-m-Y', strtotime($date . $dan));

    @$file=file(LOG_FAJL);
    if(count($file)){
        error_reporting(0);
        foreach($file as $i){

            $delovi=explode("\t",$i);
            $url=explode(".php",$delovi[0]);
            // $datum = $delovi[1];
            
            if(strtotime($delovi[1])>=$oneDayAgo){
                switch($url[1]){
                case "":$home++;$ukupno++;break;
                case "?page=home":$home++;$ukupno++;break;
                case "?page=services":$services++;$ukupno++;break;
                case "?page=clients":$clients++;$ukupno++;break;
                case "?page=news":$news++;$ukupno++;break;
                case "?page=contact":$contact++;$ukupno++;break;
                case "?page=author":$author++;$ukupno++;;break;
                default:$home++;$ukupno++;break;
                }
            }

        }

        if($ukupno>0){
            $niz[]=round($home*100/$ukupno,2);
            $niz[]=round($services*100/$ukupno,2);
            $niz[]=round($clients*100/$ukupno,2);
            $niz[]=round($news*100/$ukupno,2);
            $niz[]=round($contact*100/$ukupno,2);
            $niz[]=round($author*100/$ukupno,2);
      
        }
    }

    return $niz;
    
}
function pageVisitNum($dan){

    $niz=[];
 
    $ukupno=0;
    $home=0;
    $services=0;
    $clients=0;
    $news=0;
    $contact=0;
    // $author=0;

    $oneDayAgo=strtotime($dan);

    // $date = date('d-m-Y');
    // $prev_date = date('d-m-Y', strtotime($date . "- 1 day"));

    @$file=file(LOG_FAJL);
    if(count($file)){
        error_reporting(0);
        foreach($file as $i){

            $delovi=explode("\t",$i);
            $url=explode(".php",$delovi[0]);
            $datum = $delovi[1];
            
            if(strtotime($delovi[1])>=$oneDayAgo){
                switch($url[1]){
                case "":$home++;$ukupno++;break;
                case "?page=home":$home++;$ukupno++;break;
                case "?page=services":$services++;$ukupno++;break;
                case "?page=clients":$clients++;$ukupno++;break;
                case "?page=news":$news++;$ukupno++;break;
                case "?page=contact":$contact++;$ukupno++;break;
                case "?page=author":$author++;$ukupno++;;break;
                default:$home++;$ukupno++;break;
                }
            }

        }

        if($ukupno>0){
            $niz[]=round($home);
            $niz[]=round($services);
            $niz[]=round($clients);
            $niz[]=round($news);
            $niz[]=round($contact);
            $niz[]=round($author*100/$ukupno,2);
      
        }
    }

    return $niz;
    
}

function numOfLogUsers(){
    return count(file(LOGIN_FAJL));
}

function deleteLogin($id){
    $id=(int)$id;
    $unos="";
    @$file=file(LOGIN_FAJL);
    if(count($file)){
        foreach($file as $i){
            $iId=trim((int)$i);
            if($iId!=$id){
                $unos.=$iId."\n";
            }
        }
    }
    @$open=fopen(LOGIN_FAJL,"w");
    @fwrite($open,$unos);
    @fclose($open);
   }
?>