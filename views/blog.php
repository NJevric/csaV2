<?php

require_once("models/blog/blogSelect.php");

?>
                    <div class="tekst row d-flex justify-content-center">
                    <div class="col-md-8 col-11">
                        <?php foreach($resultBlog as $i):?>
                            <h2><?= $i->headline ?></h2>
                            <hr class="naslovHr mb-5"/> 
                            <div id="vest">
                                <p class="vestTekst"> 
                                    <?= $i->text ?>    
                                </p>
                             
                        <?php endforeach?>
                                <p class="hesteg">#CSASPORTSMANAGEMENT</p>
                            </div>    

                            
                  </div>
                