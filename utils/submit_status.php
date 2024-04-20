<?php
date_default_timezone_set('Asia/Jakarta');

function getStatusPengumpulan($deadline, $submitDate)
{
  // Mendapatkan timestamp dari waktu sekarang
  $currentTime = time();

  if (isset($submitDate)) {
    $submitDate = strtotime($submitDate);
  }

  // Jika $deadline tidak ditentukan (null)
  if (empty($deadline)) {
    // Mengembalikan pesan bahwa deadline belum ditentukan
    return "Deadline belum ditentukan";
  } else {
    // Mendapatkan waktu yang tersisa dari waktu pengumpulan
    $difference = strtotime($deadline) - $currentTime;

    // Jika waktu tersisa lebih dari 0
    if ($difference > 0 && empty($submitDate)) {
      return generateOnTimeMessage($difference);
    } elseif ($difference < 0) {
      return generateLateSubmissionMessage($deadline, $currentTime);
    } else {
      return "Tugas diserahkan tepat waktu";
    }
  }
}


function generateOnTimeMessage($difference)
{
  // Menghitung hari, jam, menit, dan detik yang tersisa
  $daysLeft = floor($difference / (60 * 60 * 24));
  $hoursLeft = floor(($difference % (60 * 60 * 24)) / 3600);
  $minutesLeft = floor(($difference % 3600) / 60);

  // Mengembalikan pesan status waktu yang tersisa
  return "Waktu pengumpulan kurang $daysLeft hari $hoursLeft jam $minutesLeft menit";
}

function generateLateSubmissionMessage($submitDate, $currentTime)
{
  // Hitung selisih waktu antara waktu pengumpulan dan deadline
  $difference = $currentTime - strtotime($submitDate);
  $hoursLate = floor($difference / 3600);
  $minutesLate = floor(($difference % 3600) / 60);
  return "Tugas terlambat diserahkan $hoursLate jam $minutesLate menit";
}
