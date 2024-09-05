<?php
require_once 'app/config/koneksi.php';
require_once 'app/config/function.php';
require_once 'app/config/function-diagnosa.php';
require_once 'app/controller/read.php';

$id_diagnosa = decrypt($_GET['ph']);
$sql = mysqli_query($koneksi, "SELECT * FROM tb_diagnosa 
    INNER JOIN tb_petani ON tb_petani.id_petani = tb_diagnosa.id_petani 
    WHERE tb_diagnosa.id_diagnosa='$id_diagnosa'
    ORDER by tb_diagnosa.tgl_diagnosa ASC");
$data_d = mysqli_fetch_array($sql);
$ph = strtolower($data_d['jenis_diagnosa']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .text-center {
            text-align: center;
        }

        .content-center {
            margin: auto;
            width: 80%;
            /* border: 3px solid green; */
            /* padding: 10px; */
        }

        .fw-bold {
            font-weight: bold;
        }

        .ukuran-kertas {
            height: 26cm;
        }

        .uk-ft {
            width: 1px;
        }

        .j-foto {
            padding-left: 100px;
        }

        .frame-foto {
            border: 2px solid black;
            padding: 5px;
            display: inline-block;
        }

        .foto {
            width: 120px;
        }

        .text-top {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <div class="ukuran-kertas">
        <center>
            <h4 style="text-transform: uppercase;">LAPORAN HASIL DIAGNOSA <br>
                <?= strtoupper($ph) ?> TANAMAN JERUK
            </h4>
            <hr>
        </center>

        <!-- START DATA MURID -->
        <table border="0" cellpadding="9" rules="none" class="content-center">
            <tbody>
                <tr>
                    <td>Tanggal Diagnosa</td>
                    <td>:</td>
                    <td><?= tanggal_indo($data_d['tgl_diagnosa']) ?></td>
                </tr>
                <tr>
                    <td>Nama Petani</td>
                    <td>:</td>
                    <td><?= $data_d['nama_lengkap'] ?></td>
                </tr>
                <tr>
                    <td>Umur Petani</td>
                    <td>:</td>
                    <td><?= hitung_umur($data_d['tgl_lahir']) ?> Tahun</td>
                </tr>
                <tr>
                    <td>Penyakit / Hama </td>
                    <td>:</td>
                    <td>
                        <?= diagnosa($data_d['id_diagnosa'], $ph, 'ph', 1); ?>
                    </td>
                </tr>
                <tr>
                    <td>Probability</td>
                    <td>:</td>
                    <td><?= diagnosa($data_d['id_diagnosa'], $ph, 'nilai_bayes', 1); ?></td>
                </tr>
                <tr>
                    <td>Nilai Persentasi</td>
                    <td>:</td>
                    <td><?= diagnosa($data_d['id_diagnosa'], $ph, 'persentase', 1); ?>%</td>
                </tr>
            </tbody>
        </table>
        <hr>

        <div class="text-center fw-bold">
            <p>DETAIL GEJALA</p>

        </div>
        <table border="0" cellpadding="9" rules="all" class="content-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Gejala</th>
                    <th>Gejala <?= $data_d['jenis_diagnosa'] ?></th>
                    <th>Bobot Gejala</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = detail_diagnosa($id_diagnosa);
                foreach ($sql as $data) {  ?>
                    <tr class="text-sm text-center">
                        <td><?= $no ?></td>
                        <td><?= $data['kode_gejala'] ?></td>
                        <td><?= $data['nama_gejala'] ?></td>
                        <td><?= $data['bobot'] ?></td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <div class="text-center fw-bold">
            <p>HASIL PENCARIAN</p>
        </div>
        <table border="0" cellpadding="9" rules="all" class="content-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penyakit</th>
                    <th>Nama Penyakit</th>
                    <th>Nilai bayes</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    <td>1</td>
                    <td><?= diagnosa($id_diagnosa, $ph, 'kode_ph', 1) ?></td>
                    <td><?= diagnosa($id_diagnosa, $ph, 'ph', 1) ?></td>
                    <td><?= diagnosa($id_diagnosa, $ph, 'nilai_bayes', 1) ?></td>
                    <td><?= diagnosa($id_diagnosa, $ph, 'persentase', 1) ?>%</td>
                </tr>
            </tbody>
        </table>
        <?php
        // Menampilkan hasil dalam bentuk tabel
        penyakit_terkait($id_diagnosa, 'tabel');

        ?>

        <div class="text-center">
            <p>GAMBAR <?= strtoupper($ph) ?> <?= diagnosa($id_diagnosa, $ph, 'ph', 1) ?> YANG DI DERITA TANAMAN JERUK</p>
            <?php
            $id_ph = diagnosa($id_diagnosa, $ph, 'id_ph', 1);
            $ce = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE id_ph = $id_ph");
            $d_fot = mysqli_fetch_array($ce);
            ?>
            <img class="foto" src="assets/img/ph/<?= $d_fot['foto'] ?>" alt="Foto" style="width: 40%;">
        </div>

        <div class="text-left ">
            <p class="fw-bold">Kesimpulan :</p>
            <?= diagnosa($id_diagnosa, $ph, 'text') ?>
        </div>

        <div class="text-left">
            <p class="fw-bold">Cara Penanganan</p>
            <ol>
                <?php
                $sql_penanganan = mysqli_query($koneksi, "SELECT * FROM tb_penanganan WHERE id_ph ='$id_ph'");
                foreach ($sql_penanganan as $pn) { ?>
                    <li><?= $pn['penanganan'] ?></li>
                <?php
                }
                ?>
            </ol>
        </div>
        <!-- END F  -->
    </div>
</body>

</html>