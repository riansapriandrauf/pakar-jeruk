<?php
require_once 'dompdf/autoload.inc.php';
// mengacu ke namespace DOMPDF
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('chroot',realpath(''));
$dompdf = new Dompdf($options);
// menggunakan class dompdf
// $dompdf = new Dompdf();

ob_start();
require_once 'view/cetak/diagnosa.php';
$html = ob_get_clean();
$dompdf->loadHtml($html);

// (Opsional) Mengatur ukuran kertas dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Menjadikan HTML sebagai PDF
$dompdf->render();

// Output akan menghasilkan PDF (1 = download dan 0 = preview)
$dompdf->stream("Codingan",array("Attachment"=>0));

?>