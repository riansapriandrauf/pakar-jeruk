<?php
$ph = ucwords(str_replace('data-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data <?= $ph ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode ph</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama ph</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Penanganan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_ph($ph);
                            foreach ($sql as $data) {
                                $id_ph = $data['id_ph'];
                                $tog = mysqli_query($koneksi, "SELECT * FROM tb_gejala_ph WHERE id_ph='$id_ph'");
                                $jumlah_gejala = mysqli_num_rows($tog);
                            ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td>
                                        <a href="gejala-<?= strtolower($ph) ?>/<?= encrypt($data['id_ph']) ?>" class="badge badge-sm bg-gradient-success"><?= $data['kode_ph'] ?></a>
                                    <td>
                                        <?= $data['nama_ph'] ?>
                                    </td>
                                    <td>
                                        <?= $jumlah_gejala ?> Gejala (<?= implode(' - ', array_gejala($id_ph, 'kode_gejala', 'ph')) ?>)
                                    </td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#gambar<?= $no ?>" class="badge badge-sm bg-gradient-success"><i class="fa fa-eye"></i></a>
                                    </td>
                                    <td>
                                        <a href="penanganan-<?= strtolower($ph) ?>/<?= encrypt($data['id_ph']) ?>" class="badge badge-sm bg-gradient-warning">
                                            Cara Penanganan
                                        </a>
                                    </td>
                                    <td class="">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>" class="badge badge-sm bg-gradient-info" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <a href="delete-ph/<?= encrypt($data['id_ph']) ?>" class="badge badge-sm bg-gradient-danger" data-toggle="tooltip" data-original-title="Edit user">
                                            Delete
                                        </a>
                                    </td>
                                </tr>


                                <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit<?= $no ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="edit<?= $no ?>">Edit <?= $ph ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="data-<?= strtolower($ph) ?>" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_ph" value="<?= $id_ph ?>">
                                                        <label for="kode_ph" class="form-label">Kode <?= $ph ?></label>
                                                        <input type="text" name="kode_ph" id="kode_ph" class="form-control" required placeholder="Kode <?= $ph ?>" value="<?= $data['kode_ph'] ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_ph" class="form-label">Nama <?= $ph ?></label>
                                                        <input type="text" name="nama_ph" id="nama_ph" class="form-control" required placeholder="Nama <?= $ph ?>" value="<?= $data['nama_ph'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="foto" class="form-label">Foto <?= $ph ?></label>
                                                        <input type="file" name="foto" id="foto" class="form-control" accept="image/">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_ph">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="gambar<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="gambar<?= $no ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title fs-5" id="gambar<?= $no ?>">
                                                    Gambar Penyakit (<?= $data['kode_ph'] ?>)
                                                    <br>
                                                    <?= $data['nama_ph'] ?>
                                                </h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="data-<?= strtolower($ph) ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group text-center">
                                                        <img src="assets/img/ph/<?= $data['foto'] ?>" alt="" width="50%">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
            <form action="data-<?= strtolower($ph) ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="jenis_ph" value="<?= $ph ?>">
                        <label for="kode_ph" class="form-label">Kode <?= $ph ?></label>
                        <input type="text" name="kode_ph" id="kode_ph" class="form-control" required placeholder="Kode <?= $ph ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_ph" class="form-label">Nama <?= $ph ?></label>
                        <input type="text" name="nama_ph" id="nama_ph" class="form-control" required placeholder="Nama <?= $ph ?>">
                    </div>
                    <div class="form-group">
                        <label for="foto" class="form-label">Foto <?= $ph ?></label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_ph">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>