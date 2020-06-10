<?php

require_once "config.php";

try {
    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

function executeOneRow($query){
    global $conn;
    return $conn->query($query)->fetch();
}

function executeQuery($query){
    global $conn;
    return $conn->query($query)->fetchAll();
}

function errorLog($error){
    $open = @fopen(ERR_FAJL,"a");
    $insert=$error."\t".date('d-m-Y H:i:s')."\n"."\n";
    @fwrite($open,$insert);
    @fclose($open);
}
   
function pageViews(){
    $open = @ fopen(LOG_FAJL, "a");
    if($open){
        $date = date('d-m-Y H:i:s');
        @ fwrite($open, "Page: "."{$_SERVER['REQUEST_URI']}\n" . "Date and Time: " . "{$date}\t" . "IP Address: "."{$_SERVER['REMOTE_ADDR']}\t\n"."\n");
        @ fclose($open);
    }
}
