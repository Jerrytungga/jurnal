

<?php
include 'database.php';
	if (isset($_POST['simpan'])){
		include "qr_code/qrlib.php"; 
		/*create folder*/
		$tempdir="img/fotoqr/";
		if (!file_exists($tempdir))
		mkdir($tempdir, 0755);
		$file_name=date("Ymd").rand().".png";	
		$file_path = $tempdir.$file_name;
		QRcode::png($_POST['nis'], $file_path, "H", 6, 4);
		/* param (1)qrcontent,(2)filename,(3)errorcorrectionlevel,(4)pixelwidth,(5)margin */
        $siswa = mysqli_query($conn, "SELECT * FROM siswa where nis='{$_POST['nis']}'");
        $s =    mysqli_fetch_array($siswa);
        $nama = $s['name'];
        $angkatan = $s['angkatan'];
        $nis = $s['nis'];
    ?> 
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  </head>
  <body>
 
  <div class="col-xl-3 mt-4 col-md-8 mb-4">
    <div class="card border-left-primary shadow h-100 py-4">
        <div class="card-body">
            <div class="row no-gutters">
                <div class="col mr-2">
                    <img src="<?= $file_path ?>" alt="...">
                </div>
                <div class="col-8">
                <div class=" h5 mt-4 font-weight-bold text-uppercase">
                <?= $nama ?></div>
                <div class="h5 font-weight-bold text-uppercase mb-1"> Angkatan : <?= $angkatan ?></div>
                <div class="h5 font-weight-bold text-uppercase mb-1"> Nis : <?=$nis ?></div>
                </div>
                </div>
                </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
    window.print()
  </script>
  </body>
</html>

<?php } ?>