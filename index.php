<?php
session_start();
require_once "./database/connection.php";

if (isset($_SESSION["login"])) {
  header("Location: dashboard.php");
}


if (isset($_POST["login"])) {

  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);

  $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  $result = $db->query($query);

  if (empty($email) || empty($password)) {
    $_SESSION["message"] = "Email dan Password Tidak Boleh Kosong!";
  } else if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $_SESSION["email"] = $row["email"];
      $_SESSION["name"] = $row["username"];
      $_SESSION["role"] = $row["role"];
      $_SESSION["id"] = $row["id"];
      $_SESSION["login"] = TRUE;
    }
    header("Location: dashboard.php");
  } else {
    $_SESSION["login"] = FALSE;
    $_SESSION["message"] = "Email atau Password salah";
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Learning Rumah Belajar Yaya | Login</title>
  <link rel="stylesheet" href="./css/login.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dashboard/dist/css/adminlte.min.css">
</head>

<body>
  <main>
    <div class="form">
      <form method="POST">
        <div class="title">
          <h1>Login</h1>
          <span>E-Learning Rumah Belajar Yaya</span>
        </div>
        <img src="./assets/logo/logo.png" alt="my-logo" class="logo">
        <div class="input-group">
          <div class="input-item">
            <input type="email" name="email" id="email" placeholder="Email" value="<?php if (isset($email)) echo $email ?>">
          </div>
          <div class="input-item">
            <input type="password" name="password" id="password" placeholder="********">
          </div>
        </div>
        <?php if (isset($_SESSION["message"])) { ?>
          <div class="alert alert-danger container-fluid" id="alert" role="alert">
            <?php if (isset($_SESSION["message"])) echo $_SESSION["message"] ?> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          </div>
        <?php unset($_SESSION["message"]);
        } ?>
        <button type="submit" name="login">Login</button>
      </form>

      <span style="margin-top: 10px; font-weight: 600;" id="copy">Copyright &copy; 2024 | E-Learning Rumah Belajar Yaya</span>
    </div>
  </main>

  <!-- jQuery -->
  <script src="./dashboard/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="./dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE -->
  <script src="./dashboard/dist/js/adminlte.js"></script>
  <script>
    setTimeout(() => {
      $("#alert").addClass("d-none");
    }, 5000)
  </script>
</body>

</html>