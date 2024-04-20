<?php
session_start();
require_once "../database/connection.php";
require_once "../utils/submit_status.php";
require_once "../auth/login.php";
login();

if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: index.php");
}

$getAssignmentQuery = "SELECT assignment.*, users.username, submission.submit_date FROM assignment LEFT JOIN users ON assignment.made_by = users.id  LEFT JOIN submission  ON assignment.id = submission.assignment_id WHERE assignment.id = " . $_GET["id"];


$getAssignment = $db->query($getAssignmentQuery)->fetch_assoc();





?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $getAssignment["title"] ?> | E-Learning Rumah Belajar Yaya</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">
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
              <h1 class="m-0"><?= $getAssignment["title"] ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="/assignment">Assignment</a></li>
                <li class="breadcrumb-item active"><?= $getAssignment["title"] ?></li>
                </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">



          <div class="container col-12 col-md-10 col-lg-6">
            <div>
              <h3>Deskripsi</h3>
              <p><?= $getAssignment["desc"] ?></p>
            </div>
            <div class="row">
              <table class="table table-striped">

                <tbody>
                  <tr>
                    <td>Judul</td>
                    <td><?= $getAssignment["title"] ?></td>
                  </tr>
                  <tr>
                    <td>Waktu Dibuat</td>
                    <td><?= $getAssignment["created_at"] ?></td>
                  </tr>
                  <tr>
                    <td>Dibuat Oleh</td>
                    <td><?= $getAssignment["username"] ?></td>
                  </tr>
                  <tr>
                    <td>Batas Pengumpulan</td>
                    <td><?= $getAssignment["deadline"] ?></td>
                  </tr>
                  <tr>
                    <td>Waktu Tersisa</td>
                    <td><?= getStatusPengumpulan($getAssignment["deadline"], $getAssignment["submit_date"]) ?></td>
                  </tr>
                  <tr>
                    <td class="text-bold">Status</td>
                    <td class="<?= $getAssignment["submit_date"] === NULL ? "bg-warning" : "bg-success" ?>"><?= $getAssignment["submit_date"] === NULL ? "Belum Dikumpulkan!" : "Sudah Dikumpulkan!" ?></td>
                    </td>
                  </tr>
                </tbody>

              </table>
            </div>
            <div class="row">
              <form action="" method="POST" class="col-sm-12">
                <div>
                  <!-- textarea -->
                  <div class="form-group">
                    <label>Message</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" style="cursor: pointer;" class="custom-file-input" id="exampleInputFile" onchange="updateFileName()" name="photo">
                    <label class="custom-file-label" for="exampleInputFile" id="fileLabel">Choose file</label>
                  </div>
                  <div class="input-group-append">
                  </div>
                </div>
                <button class="btn btn-primary mt-3" type="submit" name="upload">Submit</button>
              </form>
            </div>
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
    <?php include "../layout/footer.php" ?>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="../dashboard/dist/js/adminlte.js"></script>

  <script>
    function updateFileName() {
      var input = document.getElementById('exampleInputFile');
      var label = document.getElementById('fileLabel');
      var fileName = input.files[0].name;
      label.innerHTML = fileName;
    }
  </script>
</body>

</html>