<?php
session_start();
require_once "../database/connection.php";

if (empty($_SESSION["login"])) {
  $_SESSION["message"] = "Silahkan login terlebih dahulu";
  header("Location: /");
}

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: index.php");
}

$getAssignmentQuery = "SELECT * FROM users_assign INNER JOIN assignment ON users_assign.assignment_id = assignment.id WHERE users_assign.user_id = " . $_SESSION["id"];

$getAssignment = $db->query($getAssignmentQuery);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignment | E-Learning Rumah Belajar Yaya</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">

  <style>
    .info-box {
      cursor: pointer;
      transition: all 0.3s;
    }

    .info-box:hover {
      background-color: #eee;
    }
  </style>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="mr-3">
          <form method="POST">
            <button class="btn " type="submit" name="logout">
              <i class="fa-solid fa-right-from-bracket"></i>
            </button>
          </form>

        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include "../layout/aside.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Assignment</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Assignment</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">

            <?php foreach ($getAssignment as $assignment) { ?>
              <div class="col-12 col-sm-6 col-md-3">
                <a href="../assignment/detail.php?id=<?= $assignment['id'] ?>" class="info-box text-dark">
                  <span class="info-box-icon bg-info elevation-1">
                    <!-- <i class="fas fa-cog"></i> -->
                    <i class="fa-regular fa-clipboard"></i>
                  </span>

                  <div class="info-box-content">
                    <span class="info-box-text"><?= $assignment['title'] ?></span>
                    <span class="info-box-number">
                      19 november 2020
                    </span>
                  </div>
                  <!-- /.info-box-content -->
                </a>
                <!-- /.info-box -->
              </div>
            <?php } ?>


            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <span>Copyright &copy; 2024 | Rumah Belajar Yaya</span>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="../dashboard/dist/js/adminlte.js"></script>
</body>

</html>