<?php

require_once "config/connection.php";
  
include 'views/fixed/head.php';
include 'views/fixed/header.php';

if(!isset($_GET['page'])){
    include "views/home.php";
}

else{
    switch($_GET['page']){
        case 'services':
            include 'views/services.php';
        break;
        case 'clients':
            include 'views/clients.php';
        break;
        case 'news':
            include 'views/news.php';
        break;
        case 'contact':
            include 'views/contact.php';
        break;
        case 'player':
            include 'views/player.php';
        break;
        default:
            include 'views/home.php';
        break;
    }
}

include 'views/fixed/social.php';
include 'views/fixed/footer.php';
include 'views/fixed/loader.php';
include 'views/fixed/js.php';

?>