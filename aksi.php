<?php
session_start();
include 'database.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);


// Mencari user berdasarkan username dan password yang di input
$query  	= "SELECT * FROM mentor WHERE username='$username' AND password='$password'";
$result     = mysqli_query($conn, $query);
$num_row    = mysqli_num_rows($result);
$query2  	= "SELECT * FROM siswa WHERE username='$username' AND password='$password'";
$result2     = mysqli_query($conn, $query2);
$num_row2    = mysqli_num_rows($result2);
$query3  	= "SELECT * FROM admin WHERE username='$username' AND password='$password' ";
$result3     = mysqli_query($conn, $query3);
$num_row3    = mysqli_num_rows($result3);

// Mengecek data nya ada atau tidak
if ($num_row > 0) {
	$row    = mysqli_fetch_array($result);
	// Mengirim response ke ajax

	if ($row['status'] == "Aktif") {

		echo "Mentor";
		// Membuat Session
		$_SESSION['id_Mentor'] = $row['efata'];
		$_SESSION['role'] = "Mentor";
	} else {
		echo "Tidak Aktif";
	}

	// Jika Rolenya kasir maka fungsi ini yang akan berjalan

} else if ($num_row2 > 0) {
	$row    = mysqli_fetch_array($result2);
	// Mengirim response ke ajax
	if ($row['status'] == "Aktif") {

		echo "Siswa";
		// Membuat Session
		$_SESSION['id_Siswa'] = $row['nis'];
		$_SESSION['role'] = "Siswa";
	} else {
		echo "Tidak Aktif";
	}

	// Jika Rolenya kasir maka fungsi ini yang akan berjalan
} else if ($num_row3 > 0) {
	$row    = mysqli_fetch_array($result3);
	// Mengirim response ke ajax
	echo "Admin";
	// Membuat Session
	$_SESSION['id_Admin'] = $row['id'];
	$_SESSION['role'] = "Admin";

	// Jika Rolenya kasir maka fungsi ini yang akan berjalan

} else {
	// Mengirim response ke ajax
	echo "error";
}
