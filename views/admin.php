<?php
session_start();
 require_once("../models/admin/adminName.php"); 
 if(!isset($_SESSION['admin'])){
  header("Location:../index.php");

}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Csa Admin</title>
  <link rel="icon" type="image/x-icon" href="../assets/img/ikona.ico" /> 
  <link href="https://fonts.googleapis.com/css?family=Muli|Righteous&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Manrope&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/admin/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/admin/css/adminlte.min.css">
  <link rel="stylesheet" href="../assets/admin/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-inline-block ml-3">
        <a href="../index.php" class="nav-link">Home</a>
      </li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="mr-2"><a href="#" id="logout">Logout</a></li>     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../assets/img/logoNav.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminCsa</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 mb-3">
        <div class="image d-flex justify-content-center">
          <img src="../<?=$resultAdmin->src ?>" class="" alt="<?=$resultAdmin->alt ?>">
        </div>
        <p class="d-block text-white mb-1 d-flex justify-content-center my-2"><?=$resultAdmin->name . " " . $resultAdmin->last_name?></p>
       
        
      </div>
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="admin.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-arrows-alt-v"></i>
              <p>
                Clients
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" id="allClients">
                  <i class="fas fa-caret-right mr-1"></i>
                  <p>View All Clients</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="addClient">
                <i class="fas fa-caret-right mr-1"></i>
                  <p>Add Client</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="addPassport">
                <i class="fas fa-caret-right mr-1"></i>
                  <p>Add Passport</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
            <i class="fas fa-arrows-alt-v"></i>
              <p>
                Posts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" id="postsAll">
                <i class="fas fa-caret-right mr-1"></i>
                  <p>View All Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link" id="addPost">
                <i class="fas fa-caret-right mr-1"></i>
                  <p>Add Post</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-arrows-alt-v"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link" id="usersAll">
                <i class="fas fa-caret-right mr-1"></i>
                  <p>View All Users</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <div id="prikaz" class="d-block">
          
                
              <?php
                    require_once("../functions.php");
                    $pages=pagesAll();
                    $numOfPages=numOfPages();
              ?>
             <div class="col-12 mb-4">
                <h2 class="naslovAdmin">Dashboard</h2>
              </div>
              <div class="d-flex justify-content-center">
                <div class="col-lg-2 col-10 mx-auto">
               
                  <table class="table">
                    <thead>
                      <th colspan="<?=$numOfPages?>">Number Of Logged Users</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                       
                        <td class="font-weight-bold"><?=numOfLogUsers();?></td>
                       
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-lg-8 col-10 mx-auto tabele">
                  <table class="table">
                    <thead>
                      <th colspan="<?=$numOfPages;?>">Page views in last 24h</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($pages as $i):?>
                        <td><?=$i;?></td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisit("1 day ago") as $i):?>
                        <td><?=$i;?>%</td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisitNum("1 day ago") as $i):?>
                        <td><?=$i;?> page views</td>
                        <?php endforeach;?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table my-5">
                    <thead>
                      <th colspan="<?=$numOfPages;?>">Page views in last 7 days</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($pages as $i):?>
                        <td><?=$i;?></td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisit("7 days ago") as $i):?>
                        <td><?=$i;?>%</td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisitNum("7 days ago") as $i):?>
                        <td><?=$i;?> page views</td>
                        <?php endforeach;?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table">
                    <thead>
                      <th colspan="<?=$numOfPages;?>">Page views in last 30 days</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($pages as $i):?>
                        <td><?=$i;?></td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisit("30 days ago") as $i):?>
                        <td><?=$i;?>%</td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisitNum("30 days ago") as $i):?>
                        <td><?=$i;?> page views</td>
                        <?php endforeach;?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table my-5">
                    <thead>
                      <th colspan="<?=$numOfPages;?>">Page views in last 90 days</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($pages as $i):?>
                        <td><?=$i;?></td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisit("90 days ago") as $i):?>
                        <td><?=$i;?>%</td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisitNum("90 days ago") as $i):?>
                        <td><?=$i;?> page views</td>
                        <?php endforeach;?>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table my-5">
                    <thead>
                      <th colspan="<?=$numOfPages;?>">Page views in last 180 days</th>
                    
                    </thead>
                    <tbody>
                      <tr>
                        <?php foreach($pages as $i):?>
                        <td><?=$i;?></td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisit("180 days ago") as $i):?>
                        <td><?=$i;?>%</td>
                        <?php endforeach;?>
                      </tr>
                      <tr>
                        <?php foreach(pageVisitNum("180 days ago") as $i):?>
                        <td><?=$i;?> page views</td>
                        <?php endforeach;?>
                      </tr>
                    </tbody>
                  </table>
                </div>  
              </div>
             
            </div>
         
            
          </div>
        </div>
      </di>
    </div><!-- /.col -->
          
  </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="../assets/js/main.js"></script>

<!-- Bootstrap 4 -->
<script src="../assets/admin/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/admin/js/adminlte.min.js"></script>
</body>
</html>
