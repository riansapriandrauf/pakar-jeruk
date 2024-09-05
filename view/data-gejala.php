<?php
$ph = ucwords(str_replace('data-gejala-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-md-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Gejala <?= $ph ?></h6>
            </div>
            <div class="card-body pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="MyTable table-striped table table-bordered align-items-center mb-0" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Kode Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Gejala</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bobot</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_gejala($ph);
                            foreach ($sql as $data) {  ?>
                                <tr class="text-sm text-center fw-bold">
                                    <td><?= $no ?></td>
                                    <td style="width: 5%;">
                                        <span class="badge badge-sm bg-gradient-success">
                                            <?= $data['kode_gejala'] ?>
                                        </span>
                                    <td><?= $data['nama_gejala'] ?></td>
                                    <td><?= $data['bobot'] ?></td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>" class="badge badge-sm bg-gradient-info" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>

                                <!-- MODAL EDIT DATA  -->
                                <div class="modal fade" id="edit<?=$no?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambah" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="edit<?=$no?>">Edit Gejala</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="data-gejala-<?= strtolower($ph) ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="kode_gejala" class="form-label">Kode Gejala</label>
                                                        <input type="text" name="kode_gejala" id="kode_gejala" class="form-control" required placeholder="Kode <?= $ph ?>" value="<?=$data['kode_gejala']?>">

                                                        <input type="hidden" name="id_gejala" value="<?=$data['id_gejala']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_gejala" class="form-label">Nama Gejala</label>
                                                        <input type="text" name="nama_gejala" id="nama_gejala" class="form-control" required placeholder="Nama <?= $ph ?>" value="<?=$data['nama_gejala']?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bobot" class="form-label">Bobot</label>
                                                        <input type="text" name="bobot" id="bobot" class="form-control" required placeholder="Pengobatan" value="<?=$data['bobot']?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_gejala">Simpan</button>
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
                <h1 class="modal-title fs-5" id="tambah">Tambah Gejala</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="data-<?= strtolower($ph) ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kode_gejala" class="form-label">Kode Gejala</label>
                        <input type="text" name="kode_gejala" id="kode_gejala" class="form-control" required placeholder="Kode <?= $ph ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_gejala" class="form-label">Nama Gejala</label>
                        <input type="text" name="nama_gejala" id="nama_gejala" class="form-control" required placeholder="Nama <?= $ph ?>">
                    </div>
                    <div class="form-group">
                        <label for="bobot" class="form-label">bobot</label>
                        <input type="text" name="bobot" id="bobot" class="form-control" required placeholder="bobot">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_<?= strtolower($ph) ?>">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>