<?php
 
require_once("models/player/playerSelect.php");

?>
                    <div class="tekst row d-flex justify-content-center">
                    <div class="col-md-8 col-11">
                    
                            <h2><?=$resultClient->first_name . " " . $resultClient->last_name?></h2>
                            <hr class="naslovHr mb-4"/>
                                <?php 
                                    if( $brojKolonaTimovi==1){ echo "<p class='d-flex justify-content-center d-sm-block freeAgent'>Free Agent</p>"; }

                                    else{echo "<p class='d-flex justify-content-center d-sm-block'>Current Team: <span class='tim font-weight-bold'>$resultCurrentTeam->name</span></p>";} 
                                ?>
                             
                            <div class="row mt-4 d-flex justify-content-between">
                              
                                <div class="col-md-7">
                                <table class="table">
                                   
                                    <tbody>
                                        <tr>
                                        <th scope="row">Height</th>
                                        <td class="text-center"><?=$resultClient->height ?></td>
                                       
                                        </tr>
                                        <tr>
                                        <th scope="row">Weight</th>
                                        <td class="text-center"><?=$resultClient->weight ?></td>
                                        
                                        </tr>
                                        <tr>
                                        <th scope="row">Position</th>
                                        <td class="text-center"><?=$resultClient->position ?></td>
                                       
                                        </tr>
                                        <tr>
                                        <th scope="row">Age</th>
                                        <td class="text-center"><?=$resultClient->age ?></td>
                                       
                                        </tr>
                                        <tr>
                                        <th scope="row">Passport</th>
                                        <td class="text-center"><?=$resultClient->country ?></td>
                                       
                                        </tr>
                                        <tr>
                                            <th scope="row">Previous Teams</th>
                                        
                                            <td class="text-center">
                                                <?php 
                                                    if($brojKolonaTimovi<2){
                                                        foreach($resultPreviousTeam1 as $i){
                                                            if($brojKolonaTimovi==0){
                                                                echo "No Previous Teams";
                                                            }
                                                            else{
                                                                echo $i->name . "<br/>";
                                                            }
                                                            
                                                        }
                                                    }
                                                
                                                    else if($brojKolonaTimovi>1){
                                                        foreach($resultPreviousTeam as $i){
                                                            echo $i->name . "<br/>";
                                                        }
                                                    }
                                                ?>
                                            </td> 
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <img src="<?=$resultClient->src ?>" alt="<?=$resultClient->alt ?>" class="img-fluid"/>
                                </div>
                            </div>
                    
                  </div>
                 