<?php
function data_ph($jenis_penyakit)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE jenis_ph = '$jenis_penyakit' ORDER by kode_ph ASC");
}

function data_hama()
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_hama ORDER by kode_hama ASC");
}

function data_gejala($k)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_gejala WHERE jenis_gejala='$k' ORDER by kode_gejala ASC");
}

function data_diagnosa($id_petani, $apa)
{
    global $koneksi;
    if (empty($id_petani)) {
        return mysqli_query($koneksi, "SELECT * FROM tb_diagnosa INNER JOIN tb_petani ON tb_petani.id_petani = tb_diagnosa.id_petani WHERE jenis_diagnosa='$apa' ORDER by tgl_diagnosa DESC");
    } else {
        return mysqli_query($koneksi, "SELECT * FROM tb_diagnosa INNER JOIN tb_petani ON tb_petani.id_petani = tb_diagnosa.id_petani WHERE jenis_diagnosa='$apa' and tb_petani.id_petani = '$id_petani' ORDER by tgl_diagnosa DESC");
    }
}

function detail_diagnosa($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_detail_diagnosa INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_detail_diagnosa.id_gejala WHERE tb_detail_diagnosa.id_diagnosa='$id' ORDER by tb_gejala.kode_gejala ASC");
}

function gejala_ph($id, $target)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_gejala_ph 
        INNER JOIN tb_ph ON tb_ph.id_ph = tb_gejala_ph.id_ph
        INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_gejala_ph.id_gejala
        WHERE tb_ph.id_ph = '$id' and tb_ph.jenis_ph = '$target' order by kode_gejala ASC");
}
function array_gejala($id, $target, $jenis)
{
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM tb_gejala_$jenis INNER JOIN tb_gejala ON tb_gejala.id_gejala = tb_gejala_$jenis.id_gejala WHERE tb_gejala_$jenis.id_$jenis = $id");
    $data_array = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data_array[] = $row[$target];
        }
    }
    return $data_array;
}

function data_penanganan($id)
{
    global $koneksi;
    return mysqli_query($koneksi, "SELECT * FROM tb_penanganan WHERE id_ph = $id");
}

function foto_ph($id_ph)
{
    global $koneksi;
    $ce = mysqli_query($koneksi, "SELECT * FROM tb_ph WHERE id_ph = $id_ph");
    $d_fot = mysqli_fetch_array($ce);
    return $d_fot['foto'];
}
