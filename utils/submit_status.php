<?php
date_default_timezone_set('Asia/Jakarta');
function statusPengumpulan($deadline, $submitDate)
{
  // Mendapatkan timestamp dari waktu sekarang
  $currentTime = time();

  // Jika $deadline tidak ditentukan (null)
  if ($deadline === NULL) {
    // Mengembalikan pesan bahwa deadline belum ditentukan
    return "Deadline belum ditentukan";
  } else {
    // Mendapatkan waktu yang tersisa dari waktu pengumpulan
    $difference = strtotime($deadline) - $currentTime;

    // Menghitung jam, menit, dan detik yang tersisa
    $daysLeft = floor($difference / (60 * 60 * 24));
    $hoursLeft = floor(($difference % (60 * 60 * 24)) / 3600);
    $minutesLeft = floor(($difference % 3600) / 60);
    $secondsLeft = $difference % 60;

    // Mengembalikan pesan status waktu yang tersisa
    return "Waktu pengumpulan kurang $daysLeft hari $hoursLeft jam $minutesLeft menit $secondsLeft detik";
  }

  // Mendapatkan timestamp dari deadline
  $deadlineTime = strtotime($deadline);

  // Hitung selisih waktu antara waktu pengumpulan dan deadline
  $difference = $submitDate - $deadlineTime;

  if ($difference > 0) {
    // Tugas terlambat
    $hoursLate = floor($difference / 3600);
    $minutesLate = floor(($difference % 3600) / 60);
    return "Tugas terlambat diserahkan $hoursLate jam $minutesLate menit";
  } elseif ($difference < 0) {
    // Menghitung jam dan menit yang tersisa hingga deadline 
    $difference = $deadlineTime - $currentTime;
    $hoursLeft = floor($difference / 3600);
    $minutesLeft = floor(($difference % 3600) / 60);
    // Mengembalikan pesan status waktu yang tersisa 
    return "Waktu pengumpulan kurang $hoursLeft jam $minutesLeft menit";
  } else {
    // Tugas diserahkan tepat waktu 
    return "Tugas diserahkan tepat waktu";
  }
}
