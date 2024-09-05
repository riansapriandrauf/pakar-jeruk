<?php
if (isset($_POST['sv_ph'])) {
    $kode_ph  = $_POST['kode_ph'];
    $nama_ph  = $_POST['nama_ph'];
    $jenis_ph = $_POST['jenis_ph'];

    $nama_file          = $_FILES['foto']['name'];
    $ekstensi_izin      = array('png', 'jpg', 'jpeg');
    $pemisah_eks        = explode('.', $nama_file);
    $ekstensi           = strtolower(end($pemisah_eks));
    $file_tmp           = $_FILES['foto']['tmp_name'];
    $ukuran             = $_FILES['foto']['size'];
    $nama_baru          = date('hismdy') . '.' . $ekstensi;
    $lokasi             = 'assets/img/ph/';

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE kode_ph='$kode_ph'") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($cek) == 0) {
        if ($ukuran <= 1423232) {
            if (in_array($ekstensi, $ekstensi_izin) == true) {
                move_uploaded_file($file_tmp, $lokasi . $nama_baru);
                $kirim = mysqli_query($koneksi, "INSERT INTO tb_ph 
                (`kode_ph`, `nama_ph`, `jenis_ph`, `foto`) VALUES 
                ('$kode_ph', '$nama_ph', '$jenis_ph', '$nama_baru')")
                    or die(mysqli_error($koneksi));
                if ($kirim) {
                    echo '<script>window.addEventListener("load", berhasil)</script>';
                } else {
                    echo '<script>window.addEventListener("load", gagal)</script>';
                }
            } else {
                echo '<script>window.addEventListener("load", ekstensi_salah)</script>';
            }
        } else {
            echo '<script>window.addEventListener("load", ukuran_besar)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", double)</script>';
    }
}


if (isset($_POST['sv_gejala_ph'])) {
    $id_ph  = $_POST['id_ph'];
    $id_gejala  = $_POST['id_gejala'];

    $cek = mysqli_query($koneksi, "SELECT * FROM tb_gejala_ph WHERE id_gejala = '$id_gejala' and id_ph = '$id_ph'") or die(mysqli_error($koneksi));
    if (mysqli_num_rows($cek) == 0) {
        $kirim = mysqli_query($koneksi, "INSERT into tb_gejala_ph 
        (`id_ph`, `id_gejala`) values 
        ('$id_ph', '$id_gejala')");
        if ($kirim) {
            echo '<script>window.addEventListener("load", berhasil)</script>';
        } else {
            echo '<script>window.addEventListener("load", gagal)</script>';
        }
    } else {
        echo '<script>window.addEventListener("load", double)</script>';
    }
}


if (isset($_POST['sv_diagnosa'])) {
    $id_petani = $_POST['id_petani'];
    $tgl_diagnosa = $_POST['tgl_diagnosa'];
    $jenis_diagnosa = $_POST['jenis_diagnosa'];
    $gejala = $_POST['gejala']; // Ini akan berisi array id_gejala yang dipilih

    // Simpan data umum ke dalam tabel tb_diagnosa
    $query_diagnosa = mysqli_query($koneksi, "INSERT INTO tb_diagnosa
    (`id_petani`, `tgl_diagnosa`, `jenis_diagnosa`) VALUES 
    ('$id_petani', '$tgl_diagnosa', '$jenis_diagnosa')") or die(mysqli_error($koneksi));
    // Dapatkan ID diagnosa yang baru saja dimasukkan
    $id_diagnosa = mysqli_insert_id($koneksi); // Sesuaikan dengan cara mendapatkan ID di database Anda

    // Simpan id_gejala ke dalam tabel tb_detail_diagnosa
    foreach ($gejala as $id_gejala) {
        $query_detail = mysqli_query($koneksi, "INSERT INTO tb_detail_diagnosa 
        (`id_diagnosa`, `id_gejala`) VALUES
        ('$id_diagnosa', '$id_gejala')") or die(mysqli_error($koneksi));
    }
    if ($query_detail) {
        $id_terakhir_user = mysqli_query($koneksi, "SELECT * FROM tb_diagnosa WHERE id_petani = '$id_petani' ORDER BY id_diagnosa DESC LIMIT 1");
        $dviw12 = mysqli_fetch_array($id_terakhir_user);
?>
        <script>
            function hasil_diagnosa() {
                var diagnosisHtml = `<?= diagnosa($dviw12['id_diagnosa'], $jenis_diagnosa, 'text',1) ?>`;
                swal.fire({
                    title: "Hasil Diagnosa!",
                    html: diagnosisHtml,
                    icon: "info",
                    button: true,
                });
            }
            window.addEventListener("load", hasil_diagnosa)
        </script>
<?php
    }
}

if (isset($_POST['sv_penanganan'])) {
    $id_ph          = $_POST['id_ph'];
    $penanganan     = $_POST['penanganan'];
    $kirim = mysqli_query($koneksi, "INSERT INTO tb_penanganan (`id_ph`, `penanganan`) VALUES ('$id_ph', '$penanganan')");
    if ($kirim) {
        echo '<script>window.addEventListener("load", berhasil)</script>';
    } else {
        echo '<script>window.addEventListener("load", gagal)</script>';
    }
}
