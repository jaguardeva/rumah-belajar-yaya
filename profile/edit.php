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

  <link rel="stylesheet" href="../dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
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
                <li class="breadcrumb-item active">Edit Profile</li>
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
            <form class="col-lg-12" action="../service/user/update.php?id=<?= $_SESSION["id"] ?>" method="POST">
              <?php foreach ($get_detail_user as $user) { ?>
                <div class="card-body pt-0">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Lengkap</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" value="<?= $user["username"] ?>" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputPassword1" value="<?= $user["email"] ?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nomor Telepon</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputPassword1" value="<?= $user["phone"] ?>">
                  </div>
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control select2" style="width: 100%;" name="gender">
                      <option selected="selected"><?= $user["gender"] ?></option>
                      <option><?php if ($user["gender"] == "Laki-laki") echo "Perempuan";
                              else echo "Laki-laki"; ?></option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                      <input type="text" name="tgl_lahir" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= $user["tgl_lahir"] ?>" />
                      <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" id="exampleInputPassword1" value="<?= $user["alamat"] ?>">
                  </div>
                  <div class="d-flex justify-content-end">
                    <a href="/profile" class="mr-2"><button class="btn btn-warning" type="button">Cancel</button></a>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                  </div>
                </div>

              <?php } ?>
              <!-- /.card-body -->
            </form>
          </div>

          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <?php include "../layout/footer.php"; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="../dashboard/dist/js/adminlte.js"></script>


  <!-- Select2 -->
  <script src="../dashboard/plugins/moment/moment.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <script>
    $(function() {

      //Date picker
      $('#reservationdate').datetimepicker({
        format: 'L'
      });
    });
  </script>

</body>

</html>