<?php
$id = decrypt($_GET['id']);
$qq = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE id_ph = '$id'");
$vdata = mysqli_fetch_array($qq);
$ph = ucwords(str_replace('gejala-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah</a>
        <a href="data-<?=strtolower($ph)?>" class="btn btn-sm bg-gradient-warning"><i class="fa fa-left-arow"></i> Kembali</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Gejala <?= $ph ?> <?= $vdata['nama_ph'] ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = gejala_ph($id, $ph);
                            foreach ($sql as $data) {  ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success"><?= $data['kode_gejala'] ?></span>
                                    <td style="width: 20%;"><?= $data['nama_gejala'] ?></td>
                                    <td>
                                        <a href="#" data-bs-target="#edit<?= $no ?>" data-bs-toggle="modal" class="badge badge-sm bg-gradient-info text-white">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>

                                        <a href="#" data-bs-target="#delete<?= $no ?>" data-bs-toggle="modal" class="badge badge-sm bg-gradient-danger text-white">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>

                                <!-- MODAL DEKETE DATA  -->
                                <div class="modal fade" id="delete<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="delete">Hapus Gejala</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <h6>Yakin Ingin Menghapus Gejala <?= $data['kode_gejala'] ?></h6>
                                                <p><?= $data['nama_gejala'] ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <a href="delete-gejala-ph/<?=encrypt($data['id_gejala_ph'])?>" class="btn btn-danger">Hapus</a>
                                            </div>
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
                <h1 class="modal-title fs-5" id="tambah">Tambah Gejala</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="gejala-<?=strtolower($ph)?>/<?= $_GET['id'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_ph" value="<?= $id ?>">
                        <label for="id_gejala" class="form-label">Kode Gejala</label>
                        <select name="id_gejala" id="id_gejala" class="form-control" required>
                            <option value="">Pilih Gejala</option>
                            <?php
                            $query = data_gejala($ph);
                            foreach ($query as $view) { ?>
                                <option value="<?= $view['id_gejala'] ?>"><?= $view['kode_gejala'] ?> - <?= $view['nama_gejala'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_gejala_ph">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>