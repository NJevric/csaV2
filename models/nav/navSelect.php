<?php

function nav(){
      
      global $conn;
      $queryNav = "SELECT * FROM nav";
      $resultNav = executeQuery($queryNav);
      
      foreach($resultNav as $i):?>
      <li><a href="<?=$i->href ?>" class="link link--kukuri" data-letters="<?=$i->name ?>"> <?=$i->name ?></a></li>    
      <?php endforeach;
   
}

?>


