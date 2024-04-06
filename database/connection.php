<?php

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db_les';

$db = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if ($db->connect_error) {
  echo "Connection failed: " . mysqli_connect_error();
  exit();
}
