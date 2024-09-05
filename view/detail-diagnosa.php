<?php
$id_diagnosa = decrypt($_GET['id']);
$cari = mysqli_query($koneksi, "SELECT * FROM tb_diagnosa WHERE id_diagnosa = '$id_diagnosa'");
$view = mysqli_fetch_array($cari);
?>
<div class="row">
    <div class="col-12">
        <!-- <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah Diagnosa</a> -->
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Hasil Diagnosa</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = detail_diagnosa($id_diagnosa);
                            foreach ($sql as $data) {  ?>
                                <tr class="text-sm text-center fw-bold">
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
                    <p><?= diagnosa($id_diagnosa, $view['jenis_diagnosa'], 'text',1) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>