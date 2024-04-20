<?php

$db_host = '';
$db_user = '';
$db_pass = '';
$db_name = '';

$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
