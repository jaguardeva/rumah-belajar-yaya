<?php
session_start();
require_once "../../database/connection.php";

if (isset($_POST["submit"])) {
  var_dump($_POST);

  $username = $_POST["username"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $gender = $_POST["gender"];
  $tgl_lahir = $_POST["tgl_lahir"];
  $alamat = $_POST["alamat"];

  $query = "UPDATE users SET username = '$username', email = '$email', phone = '$phone', gender = '$gender', tgl_lahir = '$tgl_lahir', alamat = '$alamat' WHERE id = '{$_SESSION["id"]}'";

  $result = $db->query($query);

  if ($result) {
    $_SESSION["name"] = $username;
    $_SESSION["message"] = "Data berhasil diperbarui";
    header("Location: ../../profile");
  }
}
