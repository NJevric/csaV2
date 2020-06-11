<?php

$host = "localhost";
$db = "csa";
$user = "root";
$password = "";

try {
    $konekcija = new PDO("mysql:host={$host};dbname={$db};charset=utf8;", $user, $password);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}

?>