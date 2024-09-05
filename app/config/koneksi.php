<?php
function url()
{
    return "http://localhost/joki/pakar-jeruk/";
    // return "https://putri.rdm-sultra.com/";
}
$koneksi = mysqli_connect('localhost', 'root', '', 'joki_pakar-jeruk');
// $koneksi = mysqli_connect('localhost','rdms2673_rianwolo1505', 'rianwolo1505', 'rdms2673_pakar-jeruk');
if (mysqli_connect_errno()) {
    echo '<script>alert("Koneksi database gagal :' . mysqli_connect_error() . '");</script>';
}
date_default_timezone_set('Asia/Makassar');

$bulanSekarang = date('m');
$tahunSekarang = date('Y');
if ($bulanSekarang >= 1 && $bulanSekarang <= 6) {
    // Priode pertama (Januari - Juni)
    $startDate = $tahunSekarang . "-01-01";
    $endDate = $tahunSekarang . "-06-30";
} else {
    // Priode kedua (Juli - Desember)
    $startDate = $tahunSekarang . "-07-01";
    $endDate = $tahunSekarang . "-12-31";
}
