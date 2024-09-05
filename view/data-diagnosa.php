<?php
$ph = ucwords(str_replace('diagnosa-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah Diagnosa</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Diagnosa <?= $ph ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Tanggal Diagnosa</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pemilik</th>
                                <!-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Umur</th> -->
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penyakit</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Probability</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persentase</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($_SESSION['level'] == 1) {
                                $sql = data_diagnosa('', $ph);
                            } else {
                                $sql = data_diagnosa(id_petani($_SESSION['id_user']), $ph);
                            }
                            foreach ($sql as $data) {
                            ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td><?= tanggal_indo($data['tgl_diagnosa']) ?></span>
                                    <td><?= $data['nama_lengkap'] ?></td>
                                    <!-- <td><?= hitung_umur($data['tgl_lahir']) ?> Tahun</td> -->
                                    <td>
                                        <?= diagnosa($data['id_diagnosa'], $ph, 'ph', 1); ?>
                                    </td>
                                    <td>
                                        <?= diagnosa($data['id_diagnosa'], $ph, 'nilai_bayes', 1); ?><br>
                                    </td>
                                    <td>
                                        <?= diagnosa($data['id_diagnosa'], $ph, 'persentase', 1); ?>%<br>
                                    </td>
                                    <td class="">
                                        <a href="detail-diagnosa/<?= encrypt($data['id_diagnosa']) ?>" class="badge badge-sm bg-gradient-secondary text-white">
                                            Lihat Gejala
                                        </a>
                                        <a href="penanganan-<?= strtolower($ph) ?>/<?= encrypt((diagnosa($data['id_diagnosa'], $ph, 'id_ph', 1))); ?>" class="badge badge-sm bg-gradient-warning">
                                            Cara Penanganan
                                        </a>
                                        <div class="mt-2">
                                            <a target="_blank" href="cetak-diagnosa?ph=<?= encrypt($data['id_diagnosa']) ?>" class="badge badge-sm bg-gradient-success text-white">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a href="delete-diagnosa/<?= encrypt($data['id_diagnosa']) ?>" class="badge badge-sm bg-gradient-danger text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA  -->
<div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambah">Tambah <?= $ph ?></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="diagnosa-<?= strtolower($ph) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tgl_diagnosa" class="form-label">Tanggal Diagnosa</label>
                        <input type="date" name="tgl_diagnosa" id="tgl_diagnosa" class="form-control" value="<?= date('Y-m-d') ?>">
                    </div>
                    <hr>
                    <!-- Hidden data -->
                    <input type="hidden" name="jenis_diagnosa" value="<?= $ph ?>">
                    <?php
                    if ($_SESSION['level'] == 2) { ?>
                        <input type="hidden" name="id_petani" value="<?= id_petani($_SESSION['id_user']) ?>">
                    <?php
                    } else { ?>
                        <div class="form-group">
                            <label for="">Pilih Petani</label>
                            <select name="id_petani" class="form-control" required>
                                <option value="">Pilih Petani</option>
                                <?php
                                $cek_p = mysqli_query($koneksi, "SELECT * FROM tb_petani");
                                foreach ($cek_p as $dvw) { ?>
                                    <option value="<?= $dvw['id_petani'] ?>"><?= $dvw['nama_lengkap'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- End hidden data -->
                    <div class="form-group">
                        <label for="" class="form-label">Pilih Gejala</label>
                        <?php
                        $query = data_gejala($ph);
                        foreach ($query as $gejala) {
                        ?>
                            <div class="form-group">
                                <input type="checkbox" id="gejala_<?= $gejala['id_gejala'] ?>" name="gejala[]" value="<?= $gejala['id_gejala'] ?>">
                                <label for="gejala_<?= $gejala['id_ge jala'] ?>" class="form-label"><?= $gejala['kode_gejala'] . ' - ' . $gejala['nama_gejala'] ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_diagnosa">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>