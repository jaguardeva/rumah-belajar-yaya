<?php
session_start();
require_once "../database/connection.php";
require_once "../auth/login.php";
login();

// Logout handling
if (isset($_POST["logout"])) {
  session_destroy();
  header("Location: index.php");
  exit; // Stop further execution
}

// Fetch assignment details
$getAssignmentQuery = "SELECT * FROM users_assign INNER JOIN assignment ON users_assign.assignment_id = assignment.id WHERE users_assign.user_id = " . htmlspecialchars($_SESSION["id"]);
$getAssignment = $db->query($getAssignmentQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Assignment | E-Learning Rumah Belajar Yaya</title> <!-- Escape output -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../dashboard/dist/css/adminlte.min.css">

  <style>
    .info-box:hover {
      background-color: #eee;
      transition: all 0.2s;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->

    <?php include "../layout/navigation.php" ?>
    <!-- Main Sidebar Container -->
    <?php include "../layout/aside.php" ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Assignment</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a href="/assignment">Assignment</a></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <?php foreach ($getAssignment as $assignment) { ?>
              <div class="col-12 col-sm-6 col-md-3">
                <a href="./assignment/detail.php?id=<?= $assignment["id"] ?>" class="info-box" style="cursor: pointer; color:black; cursor:pointer;">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text text-bold"><?= htmlspecialchars($assignment["title"]) ?></span>
                    <span class="info-box-text">
                      <?= htmlspecialchars($assignment["created_at"]) ?>
                    </span>
                  </div>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <!-- Main Footer -->
    <?php include "../layout/footer.php" ?>
  </div>
  <!-- REQUIRED SCRIPTS -->
  <script src="../dashboard/plugins/jquery/jquery.min.js"></script>
  <script src="../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dashboard/dist/js/adminlte.js"></script>

</body>

</html>