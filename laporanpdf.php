<?php
include "vendor/autoload.php";
$mpdf = new \Mpdf\Mpdf();
?>


<h3>Laporan Final jurnal PKA</h3>
<hr>




<?php
$html = ob_get_contents();
$mpdf->WriteHTML(utf8_decode($html));
$mpdf->Output("Data Laporan", "I");
exit;
?>