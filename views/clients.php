<?php
 require_once("models/clients/clientsFilter.php");

?>
                    <div class="tekst row d-flex justify-content-center">
                        <div class="col-lg-8 col-md-10 col-11">
                            <h2>CSA Sports Management Clients</h2>
                            <hr class="naslovHr"/>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <p class="d-flex justify-content-center d-sm-block" id="proba">Scroll to see our list of clients</p>
                                </div>
                                <div class="col-sm-8 col-12 d-flex mb-4 mb-lg-0 justify-content-center">
                                    <div class="filterActive mr-sm-4 mr-2">
                                        <select class="form-control form-control-md" id="contractDdl" name="contractDdl">
                                        
                                        </select>
                                    </div>
                                    <div class="filterPosition">
                                        <div class="selectBox" onclick="prikaziChbZaFilter()">
                                            <select class="form-control form-control-md" id="position">
                                                <option value="0">Client Position</option>
                                            </select>
                                            <div class="sakrijOption"></div>
                                        </div>
                                        <div id="chbs">
            
                                        </div>
                                    </div>
                                </div>
                               
                          
                            </div>
                            
                            <div id="clients" class="row float-left mt-4"> <!-- stavi d-flex za scroll po x osi-->
                                    <?php   
                                       
                                    ?>
                               </div>
                               
                        </div>
                       