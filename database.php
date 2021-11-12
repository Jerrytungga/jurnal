<?php

// menghubungkan ke database
$conn = mysqli_connect("127.0.0.1", "root", "#dbabsensipka#", "jurnal")  or die("Gagal");




// bar cart siswa
$angkatan  = mysqli_query($conn, "SELECT angkatan FROM siswa order by nis asc");
$name      = mysqli_query($conn, "SELECT name FROM siswa order by nis asc");


// menghitung jumlah siswa aktif
$get1 = mysqli_query($conn, "SELECT * FROM siswa WHERE status='Aktif' ");
$count1 = mysqli_num_rows($get1);
// menghitung total siswa
$get2 = mysqli_query($conn, "SELECT * FROM siswa ");
$count2 = mysqli_num_rows($get2);
// menghitung jumlah mentor
$get3 = mysqli_query($conn, "SELECT * FROM mentor WHERE status='Aktif'");
$count3 = mysqli_num_rows($get3);
// menghitung jumlah mentor
$get4 = mysqli_query($conn, "SELECT * FROM mentor");
$count4 = mysqli_num_rows($get4);
