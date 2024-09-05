<?php
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
// require_once 'app/config/function-diagnosa.php';
require_once 'app/controller/read.php';

require_once 'diagnosa.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .table {
            margin: auto;
            width: 80%;
            /* border: 3px solid green; */
            padding: 10px;
        }
    </style>
</head>

<body>

    <hr>
    <?php
    $cari_id = 45;
    ?>
    <center><b>DATA ID <?= $cari_id ?></b></center>
    <table border="0" cellpadding="9" rules="all" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Gejala</th>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no2 = 1;
            $sql2 = detail_diagnosa($cari_id);
            foreach ($sql2 as $view) { ?>
                <tr>
                    <td><?= $no2 ?></td>
                    <td><?= $view['id_gejala'] ?></td>
                    <td><?= $view['kode_gejala'] ?></td>
                    <td><?= $view['nama_gejala'] ?></td>
                    <td><?= $view['bobot'] ?></td>
                </tr>
            <?php
                $no2++;
            }
            ?>
        </tbody>
    </table>
    <center><b>MODEL PERHITUNGAN</b></center>
    <ol>
        <li>Nama Penyakit : <?= cek_penyakit($cari_id, 'ph'); ?></li>
        <li>Jumlah Bobot : <?= cek_penyakit($cari_id, 'total_bobot'); ?></li>
        <li>Nilai Hipotesa Tanpa Audience : <?php print_r(cek_penyakit($cari_id, 'nilai_hipotesa')); ?></li>
        <li>Nilai Hipotesa Mandang Audience : <?php print_r(cek_penyakit($cari_id, 'nilai_hipotesa_audience')); ?></li>
        <li>Nilai Hipotesa Mandang Audience (array) : <?php print_r(cek_penyakit($cari_id, 'nilai_hipotesa_audience_array')); ?></li>
        <li>Nilai Hi | E : <?php print_r(cek_penyakit($cari_id, 'nilai_Hi_E')); ?></li>
        <li>Nilai Bayes : <?php print_r(cek_penyakit($cari_id, 'nilai_bayes')); ?></li>
        <li>Persentase : <?php print_r(cek_penyakit($cari_id, 'persentase')); ?></li>
    </ol>
</body>

</html>