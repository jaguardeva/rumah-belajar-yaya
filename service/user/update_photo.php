<?php
session_start();
require_once "../../database/connection.php";

if (isset($_POST["upload"])) {

  $fileName = $_FILES["photo"]["name"];
  $fileSize = $_FILES["photo"]["size"];
  $tmpName = $_FILES["photo"]["tmp_name"];
  $error = $_FILES["photo"]["error"];

  var_dump($tmpName);

  $validImageExtension = ['jpg', 'jpeg', 'png'];
  $imageExtension = explode('.', $fileName);
  $imageExtension = strtolower(end($imageExtension));

  if (!in_array($imageExtension, $validImageExtension)) {
    $_SESSION["error"] = "Unggahan gagal. Ekstensi gambar tidak sesuai.";
    header("Location: ../../profile");
    exit();
  }

  if ($fileSize > 2000000) {
    $_SESSION["error"] = "Unggahan gagal. Ukuran gambar tidak boleh melebihi 2MB.";
    header("Location: ../../profile");
    exit();
  }

  if ($error === 4) {
    $_SESSION["error"] = "Tidak ada gambar yang dipilih.";
    header("Location: ../../profile");
    exit();
  }

  // Hapus foto lama jika ada
  $querySelect = "SELECT img FROM users WHERE id = '$_SESSION[id]'";
  $resultSelect = $db->query($querySelect);
  if ($resultSelect && $resultSelect->num_rows > 0) {
    $row = $resultSelect->fetch_assoc();
    $oldFileName = $row['img'];
    $filePath = "../../public/image/" . $oldFileName;
    if (file_exists($filePath)) {
      unlink($filePath); // Hapus foto lama
    }
  }

  // Kemudian proses upload foto baru dan perbarui basis data
  $newFileName = "IMG" . uniqid() . "." . $imageExtension;
  $filePath = "../../public/image/" . $newFileName;
  move_uploaded_file($tmpName, $filePath);

  $query = "UPDATE users SET img = '$newFileName' WHERE id = '$_SESSION[id]'";
  $result = $db->query($query);

  if ($result) {
    $_SESSION["message"] = "Unggahan gambar berhasil.";
    $_SESSION["image"] = $newFileName;
    header("Location: ../../profile");
    exit();
  } else {
    $_SESSION["error"] = "Gagal memperbarui gambar.";
    header("Location: ../../profile");
    exit();
  }
}
