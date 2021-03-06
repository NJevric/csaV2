<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <meta name="description" content="CSA Sports Management is a full-service sports management agency dedicated to providing clients and partners with assistance in contract negotiation, career + brand management services and financial planning with the utmost professionalism, reliability and transparency."/>
        <meta name="keywords" content="CSA,csa,introducing,player,sports,sports management,agency,guard,ncaa,"/>
        <meta name="copyright" content="59Develop 2019"/>
        <title>CSA Sports Management | Register</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/style.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
        <link rel="icon" type="image/x-icon" href="../assets/img/ikona.ico" /> 
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"/>
    </head>
    <body>
        <div id="login" class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mx-auto login_background">
                    <form action="" method="POST" class="loginForma registerForm">
                    <img src="../assets/img/logoHeader.png" alt="CSA Logo" class="logoLogin text-center"/>
                    <h2 class="text-white">Register</h2>
                        <div class="form-group row">
                            <div class="col-lg-12 col-12 mb-0 mb-md-0 mx-auto">
                                <i class="fas fa-user-alt loginIco"></i>
                                <input type="text" class="" name="firstNameRegister" id="firstNameRegister" placeholder="First Name" onfocus="this.placeholder=''" onblur="this.placeholder='Username'"/>
                                <p class="errorMsgRegister text-white" id="errorMsgFirstName"></p>
                            </div>
                            <div class="col-lg-12 col-12 mb-0 mb-md-0 mx-auto">
                                <i class="fas fa-user-alt loginIco"></i>
                                <input type="text" class="" name="lastNameRegister" id="lastNameRegister" placeholder="Last Name" onfocus="this.placeholder=''" onblur="this.placeholder='Username'"/>
                                <p class="errorMsgRegister text-white" id="errorMsgLastName"></p>
                            </div>
                            <div class="col-lg-12 col-12 mb-0 mb-md-0 mx-auto">
                                <i class="far fa-envelope loginIco"></i>
                                <input type="text" class="" name="usernameRegister" id="usernameRegister" placeholder="Email" onfocus="this.placeholder=''" onblur="this.placeholder='Username'"/>
                                <p class="errorMsgRegister text-white" id="errorMsgEmail"></p>
                            </div>
                            <div class="col-lg-12 col-12 mb-3 mb-md-0 mx-auto">
                                <i class="fas fa-unlock-alt loginIco"></i>
                                <input type="password" class="" name="passRegister" id="passRegister" placeholder="Password" onfocus="this.placeholder=''" onblur="this.placeholder='Password'"/>
                                <p class="errorMsgRegister text-white" id="errorMsgPass"></p>
                            </div>
                            <div class="col-lg-12 col-12 mb-3 mb-md-0 mx-auto">
                                <input type="button" class="btn-danger btnSubmit mt-4" name="btnRegister" id="btnRegister" value="Register"/>
                                <p class="text-center mt-4 text-white">Already have an account? <a href="login.php" class="text-primary font-weight-bold">Member Login</a></p>
                                <p class="text-center mt-4 text-white">Go back to <a href="../index.php" class="text-primary font-weight-bold">home page </a></p>
                            </div>
                            <!-- <div class="errorMsgLogin col-lg-12 col-10 mb-3 mb-md-0 mx-auto">
                             
                            </div> -->
                        </div>
                    </form>
                    
                </div>
             </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script src="../assets/js/main.js"></script>
    </body>
</html>