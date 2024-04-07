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

$query  = "SELECT * FROM users WHERE id = " . $_SESSION["id"];
$get_detail_user = $db->query($query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile | E-Learning Rumah Belajar Yaya</title>

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

    <?php include "../layout/navigation.php"; ?>

    <?php include "../layout/aside.php"; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>

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
            <div class="col-lg-4 d-flex flex-column align-items-center justify-content-center">
              <img src="../public/image/pas-photo-almet.png" width="150" alt="pas-photo-almet.png" loading="lazy">
              <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" style="cursor: pointer;" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <table class="table table-striped">
                <tbody>
                  <?php foreach ($get_detail_user as $user) { ?>
                    <tr>
                      <th>Nama:</th>
                      <td><?= $user["username"] ?></td>
                    </tr>
                    <tr>
                      <th>Email:</th>
                      <td><?= $user["email"] ?></td>
                    </tr>
                    <tr>
                      <th>Phone:</th>
                      <td><?= $user["phone"] ?></td>
                    </tr>
                    <tr>
                      <th>Jenis Kelamin:</th>
                      <td><?= $user["gender"] ?></td>
                    </tr>
                    <tr>
                      <th>Tanggal Lahir:</th>
                      <td><?= $user["tgl_lahir"] ?></td>
                    </tr>
                    <tr>
                      <th>Alamat:</th>
                      <td><?= $user["alamat"] ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <a href="../profile/edit.php?id=<?= $_SESSION["id"] ?>"><button class="btn btn-primary">Edit Data</button></a>

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
    <?php include "../layout/footer.php"; ?>
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