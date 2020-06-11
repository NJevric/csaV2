<div id="csaHeader" class="container-fluid">
            <div class="row">
                <div id="home_background" class="col-xl-4 col-lg-12 home">
                    <div class="naslov">
                    <img src="assets/img/logoHeader.png" alt="CSA Logo" class="logoHome" onclick="window.location='index.php?page=home'"/>
                        <h1>CSA Sports Management</h1>
                        <h4> A Premier Sports Agency. Creating a Legacy.</h4>
                        <p class="est">est 2019</p>
                    </div>
                </div>
                <div id="hamburgerTelefon">
                        <div class="hamTelefon"></div>
                        <div class="hamTelefon"></div>
                        <div class="hamTelefon"></div>
                    </div>
                    <div class="navigacijaTelefon">
                        <ul class="nav-linksTelefon">
                        <?php
                            require_once("models/nav/navSelect.php");
                            nav();
                        ?>
                        </ul>
                    </div>
                          
                <div id="home_text" class="col-xl-8 col-lg-12">
                    <div id="hamburger">
                        <div class="ham"></div>
                        <div class="ham"></div>
                        <div class="ham"></div>
                    </div>
                   <div class="navigacija">
                        <ul class="nav-links">
                        <?php
                            require_once("models/nav/navSelect.php");
                            nav();
                        ?>
                        </ul>
                    </div>
                    
                   
                   
                   