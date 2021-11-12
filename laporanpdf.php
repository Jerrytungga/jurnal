<?php
include "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
?>


<h3>Laporan Final jurnal PKA</h3>
<hr>
<h1 class="text-danger">Mohon Maaf, Halaman ini masih dalam proses pengembangan</h1>




<?php
$html = ob_get_contents();
$mpdf->WriteHTML(utf8_decode($html));
$mpdf->Output("Data Laporan", "I");
exit;
?>