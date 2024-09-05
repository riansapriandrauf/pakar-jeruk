<?php
$id_ph = decrypt($_GET['id']);
$cari = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE id_ph = '$id_ph'");
$view = mysqli_fetch_array($cari);
$ph = ucwords(str_replace('penanganan-', '', $_GET['page']));
?>
<div class="row">
    <div class="col-12">
        <a data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-sm bg-gradient-success"><i class="fa fa-plus"></i> Tambah Pananganan</a>
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Penanganan <?= $ph . ' ' . $view['nama_ph'] ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="MyTable table table-striped table-bordered align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">No</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 5%;">Penanganan</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = data_penanganan($id_ph);
                            foreach ($sql as $data) {  ?>
                                <tr class="text-sm fw-bold">
                                    <td class="text-center"><?= $no ?></td>
                                    <td><?= $data['penanganan'] ?></span>
                                    <td class="text-center">
                                        <a href="" data-bs-toggle="modal" data-bs-target="#edit<?= $no ?>" class="badge badge-sm bg-gradient-info" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                        <a href="delete-penanganan/<?= encrypt($data['id_penanganan']) ?>" class="badge badge-sm bg-gradient-danger text-white">Delete
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="edit<?= $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="edit">EDIT <?= $ph ?></h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="penanganan-<?= strtolower($ph) ?>/<?= $_GET['id'] ?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="penanganan" class="form-label">Cara Penanganan</label>
                                                        <input type="text" name="penanganan" id="penanganan" class="form-control" placeholder="Masukkan cara penanganan" value="<?= $data['penanganan'] ?>">

                                                        <input type="hidden" name="id_penanganan" value="<?= $data['id_penanganan'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="edit_penanganan">Simpan</button>
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
            <form action="penanganan-<?= strtolower($ph) ?>/<?= $_GET['id'] ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="penanganan" class="form-label">Cara Penanganan</label>
                        <input type="text" name="penanganan" id="penanganan" class="form-control" placeholder="Masukkan cara penanganan">
                        <input type="hidden" name="id_ph" value="<?= $id_ph ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="sv_penanganan">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>