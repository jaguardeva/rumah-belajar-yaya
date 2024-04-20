<?php

function login()
{
  if (empty($_SESSION["login"])) {
    $_SESSION["message"] = "Silahkan login terlebih dahulu!";
    header("Location: /");
  }
}
