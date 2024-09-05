<?php

function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function hitung_umur($tanggal_lahir)
{
    $birthDate = new DateTime($tanggal_lahir);
    $today = new DateTime("today");
    if ($birthDate > $today) {
        exit("0 tahun 0 bulan 0 hari");
    }
    $y = $today->diff($birthDate)->y;
    $m = $today->diff($birthDate)->m;
    $d = $today->diff($birthDate)->d;
    // return $y . " tahun " . $m . " bulan " . $d . " hari";
    return $y;
}

function text_angka($angka)
{
    if ($angka == "1") {
        $text = 'Satu';
    } else if ($angka == "2") {
        $text = 'Dua';
    } else if ($angka == "3") {
        $text = 'Tiga';
    } else if ($angka == "4") {
        $text = 'Empat';
    } else if ($angka == "5") {
        $text = 'Lima';
    } else if ($angka == "6") {
        $text = 'Rnam';
    } else if ($angka == "7") {
        $text = 'Tujuh';
    } else if ($angka == "8") {
        $text = 'Delapan';
    } else if ($angka == "9") {
        $text = 'Sembilan';
    } else if ($angka == "10") {
        $text = 'Sepuluh';
    } else if ($angka == "11") {
        $text = 'Sebelas';
    } else if ($angka == "12") {
        $text = 'Dua Belas';
    } else if ($angka == "13") {
        $text = 'Tiga Belas';
    } else if ($angka == "14") {
        $text = 'Empat Belas';
    } else if ($angka == "15") {
        $text = 'Lima Belas';
    } else if ($angka == "16") {
        $text = 'Enam Belas';
    } else if ($angka == "17") {
        $text = 'Tujuh Belas';
    } else if ($angka == "18") {
        $text = 'Delapan Belas';
    } else if ($angka == "19") {
        $text = 'Sembilan Belas';
    } else if ($angka == "20") {
        $text = 'Dua Puluh';
    }

    return $text;
}

function jenis_kelamin($j)
{
    if ($j == 'P') {
        return "Perempuan";
    } else if ($j == "L") {
        return "Laki-Laki";
    } else {
        return "?";
    }
}

function kembali()
{
    $link = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $data = 'window.location="' . $link . '"';
    return $data;
}

function rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    return 'Rp ' . $rupiah;
}

function terbilangRupiah($angka)
{
    $angka = abs((int)$angka);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

    $terbilang = "";
    if ($angka < 12) {
        $terbilang = $huruf[$angka];
    } elseif ($angka < 20) {
        $terbilang = terbilangRupiah($angka - 10) . " belas";
    } elseif ($angka < 100) {
        $terbilang = terbilangRupiah($angka / 10) . " puluh " . terbilangRupiah($angka % 10);
    } elseif ($angka < 200) {
        $terbilang = "seratus " . terbilangRupiah($angka - 100);
    } elseif ($angka < 1000) {
        $terbilang = terbilangRupiah($angka / 100) . " ratus " . terbilangRupiah($angka % 100);
    } elseif ($angka < 2000) {
        $terbilang = "seribu " . terbilangRupiah($angka - 1000);
    } elseif ($angka < 1000000) {
        $terbilang = terbilangRupiah($angka / 1000) . " ribu " . terbilangRupiah($angka % 1000);
    } elseif ($angka < 1000000000) {
        $terbilang = terbilangRupiah($angka / 1000000) . " juta " . terbilangRupiah($angka % 1000000);
    } else {
        $terbilang = "Angka terlalu besar untuk diubah menjadi terbilang";
    }

    return ucfirst($terbilang); // Mengubah huruf pertama menjadi huruf besar
}

function rupiah_to_int($uang)
{
    return str_replace(".", "", str_replace("Rp", "", $uang));
}

function status_bayar($a)
{
    if ($a == 0) {
        $data = "<button class='btn btn-outline-success'>Lunas</button>";
    } else {
        $data = "<button class='btn btn-outline-warning'>Belum Lunas</button>";
    }
    return $data;
}

function kirim_pesan($to, $text)
{
    $data_kirim = array(
        'session' => 'rian',
        'to' => $to,
        'text' => $text
    );
    $ch = curl_init('https://wa-gateway.rianrauf.my.id/send-message');

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data_kirim));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);
}
function bacawaktu()
{
    $time = date('H:i:s');
    $hour = (int) date('H', strtotime($time));
    if ($hour >= 0 && $hour < 6) {
        return "malam";
    } elseif ($hour >= 6 && $hour < 12) {
        return "pagi";
    } elseif ($hour >= 12 && $hour < 15) {
        return "siang";
    } elseif ($hour >= 15 && $hour < 18) {
        return "sore";
    } else {
        return "malam";
    }
}

function code()
{
    return "HALO NAMA SAYA ABDUL JABAL";
}

function encrypt($id)
{
    $data = base64_encode($id . code());
    return $data;
}

function decrypt($id)
{
    $kode = base64_decode($id);
    $data = str_replace(code(), "", $kode);
    return $data;
}

function no_telp($no)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $no);
    // Jika dimulai dengan '0', ganti dengan '62'
    if (substr($phoneNumber, 0, 1) === '0') {
        $phoneNumber = '62' . substr($phoneNumber, 1);
    }
    return $phoneNumber;
}


function active_link($acuan, $target)
{
    if ($acuan == $target) {
        return "text-white active bg-info";
    }
}

function id_petani($id_user)
{
    global $koneksi;
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_petani WHERE id_user = '$id_user'");
    $data = mysqli_fetch_array($sql);
    return $data['id_petani'];
}
