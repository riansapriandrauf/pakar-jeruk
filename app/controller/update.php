<?php
if (isset($_POST['edit_ph'])) {
    $id_ph    = $_POST['id_ph']; // ID yang digunakan untuk identifikasi data yang akan di-edit
    $nama_ph  = $_POST['nama_ph'];

    $nama_file     = $_FILES['foto']['name'];
    $ekstensi_izin = array('png', 'jpg', 'jpeg');
    $pemisah_eks   = explode('.', $nama_file);
    $ekstensi      = strtolower(end($pemisah_eks));
    $file_tmp      = $_FILES['foto']['tmp_name'];
    $ukuran        = $_FILES['foto']['size'];
    $nama_baru     = date('hismdy') . '.' . $ekstensi;
    $lokasi        = 'assets/img/ph/';

    // Cek apakah ID PH ada di database
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE id_ph='$id_ph'") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($cek) > 0) {
        // Jika ada file foto yang diunggah
        if ($nama_file) {
            if ($ukuran <= 1423232) {
                if (in_array($ekstensi, $ekstensi_izin) == true) {
                    move_uploaded_file($file_tmp, $lokasi . $nama_baru);
                    $update = mysqli_query($koneksi, "UPDATE tb_ph SET 
                    nama_ph='$nama_ph',
                    foto='$nama_baru' 
                    WHERE id_ph='$id_ph'") or die(mysqli_error($koneksi));
                } else {
                    echo '<script>window.addEventListener("load", ekstensi_salah)</script>';
                }
            } else {
                echo '<script>window.addEventListener("load", ukuran_besar)</script>';
            }
        } else {
            // Jika tidak ada file foto yang diunggah
            $update = mysqli_query($koneksi, "UPDATE tb_ph SET 
            nama_ph='$nama_ph'
            WHERE id_ph='$id_ph'") or die(mysqli_error($koneksi));
        }

        if ($update) {
            echo '<script>window.addEventListener("load", berhasil)</script>';
        } else {
            echo '<script>window.addEventListener("load", gagal)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", tidak_ada)</script>';
    }
}




if (isset($_POST['edit_gejala'])) {
    $id_gejala = $_POST['id_gejala'];
    $kode_gejala = $_POST['kode_gejala'];
    $nama_gejala = $_POST['nama_gejala'];
    $bobot = $_POST['bobot'];

    $update = mysqli_query($koneksi, "UPDATE tb_gejala SET 
        kode_gejala='$kode_gejala',
        nama_gejala='$nama_gejala',
        bobot='$bobot'
        WHERE id_gejala = '$id_gejala'");

    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}

if (isset($_POST['edit_penanganan'])) {
    $id_penanganan = $_POST['id_penanganan'];
    $penanganan = $_POST['penanganan'];

    $update = mysqli_query($koneksi, "UPDATE tb_penanganan SET 
        penanganan='$penanganan'
        WHERE id_penanganan = '$id_penanganan'");

    if ($update) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}

