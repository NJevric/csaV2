<?php
 
require_once("models/player/playerSelect.php");

?>
                    <div class="tekst row d-flex justify-content-center">
                    <div class="col-md-8 col-11">
                    
                            <h2><?=$resultClient->first_name . " " . $resultClient->last_name?></h2>
                            <hr class="naslovHr mb-4"/>
                            <h6 class="d-flex justify-content-center d-sm-block mb-1 mb-sm-4">Contact us for more information</h6>
                            <div class="col-8 mx-auto my-3 d-block d-sm-none">
                                    <img src="<?=$resultClient->src ?>" alt="<?= $resultClient->alt ?>" class="img-fluid"/>
                            </div>
                                <?php 
                                    if( $brojKolonaTimovi==1 && $resultTeamActive0 || $brojKolonaTimovi>1 && $resultPreviousTeamActive0 || $brojKolonaTimovi==0){ 
                                        echo "<p class='d-flex justify-content-center d-sm-block freeAgent'>Free Agent</p>"; }
                                    else if( $brojKolonaTimovi==1 && $resultTeamActive1){
                                        echo "<p class='d-flex justify-content-center d-sm-block'>Current Team: <span class='tim font-weight-bold'>$resultTeamActive1->name</span></p>";
                                    }
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
                                        <?php  if($resultNumPosition->numPos == "1"):?>
                                            <td class="text-center"><?=$resultClient->position ?></td>
                                          <?php endif; ?>
                                          <?php if($resultNumPosition->numPos == "2"):?>
                                            <td class="text-center">
                                                <?php foreach ($resultPosition as $i):?>
                                                    <?=$i->posName . " /"?>
                                                <?php endforeach; ?>
                                            </td>
                                        <?php endif; ?>
                                        
                                       
                                        </tr>
                                        <tr>
                                        <th scope="row">DOB</th>
                                        <td class="text-center"><?=$resultClient->dob ?></td>
                                       
                                        </tr>
                                        <tr>
                                        <th scope="row">Passport</th>
                                          <?php  if($resultCountPassport->numCountry == "1"):?>
                                            <td class="text-center"><?=$resultClient->country ?></td>
                                          <?php endif; ?>
                                          <?php if($resultCountPassport->numCountry == "2"):?>
                                            <td class="text-center">
                                                <?php foreach ($resultPassport as $i):?>
                                                    <?=$i->country . " /"?>
                                                <?php endforeach; ?>
                                            </td>
                                        <?php endif; ?>
                               
                                       
                                        </tr>
                                        <tr>
                                            <th scope="row">Previous Teams</th>
                                            <td class="text-center">
                                                <?php 
                                                    if($brojKolonaTimovi<2){
                                                            if( $brojKolonaTimovi==1 && $resultTeamActive1 || $brojKolonaTimovi==0){ 
                                                                 echo "No Previous Teams";
                                                            }
                                                            else{
                                                                 echo $resultTeamActive0->name . "<br/>";
                                                            }
                                                    }
                                                    else if($brojKolonaTimovi>1){
                                                        if($resultPreviousTeamActive0){
                                                            foreach($resultPreviousTeamActive0 as $i){
                                                                echo $i->name . "<br/>";
                                                            }
                                                        }
                                                        if($resultPreviousTeam)
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
                                <div class="col-md-4 mx-auto my-3 d-none d-sm-block">
                                    <img src="<?=$resultClient->src ?>" alt="<?= $resultClient->alt ?>" class="img-fluid"/>
                                </div>
                            </div>
                    
                  </div>
                 