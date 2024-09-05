<?php
// Fungsi untuk menghitung probabilitas dengan mempertimbangkan bobot gejala tertinggi
// function hitung_probabilitas($ids_ph, $id_gejala_dipilih)
// {
//     global $koneksi;
//     $probabilitas = [];
//     $bobot_gejala_tertinggi = 0.8; // Nilai bobot gejala tertinggi

//     // Menghapus ID duplikat dari $ids_ph
//     $ids_ph = array_unique($ids_ph);

//     // Persiapkan query untuk menghitung total gejala untuk penyakit/hama tertentu
//     $stmt_total = $koneksi->prepare("SELECT COUNT(*) AS total FROM tb_gejala_ph WHERE id_ph = ?");
//     if (!$stmt_total) {
//         die('Prepare failed: ' . $koneksi->error);
//     }

//     // Persiapkan query untuk menghitung jumlah gejala yang dipilih sesuai dengan penyakit/hama tertentu
//     $placeholders = implode(', ', array_fill(0, count($id_gejala_dipilih), '?'));
//     $stmt_selected = $koneksi->prepare("SELECT COUNT(*) AS count FROM tb_gejala_ph WHERE id_ph = ? AND id_gejala IN ($placeholders)");
//     if (!$stmt_selected) {
//         die('Prepare failed: ' . $koneksi->error);
//     }

//     foreach ($ids_ph as $id_ph) {
//         // Hitung total gejala untuk penyakit/hama tertentu
//         $stmt_total->bind_param("i", $id_ph);
//         $stmt_total->execute();
//         $result_total = $stmt_total->get_result();
//         $total_gejala = $result_total->fetch_assoc()['total'];

//         // Hitung jumlah gejala yang dipilih sesuai dengan penyakit/hama tertentu
//         $types = str_repeat('i', count($id_gejala_dipilih) + 1);
//         $params = array_merge([$id_ph], $id_gejala_dipilih);
//         $stmt_selected->bind_param($types, ...$params);
//         $stmt_selected->execute();
//         $result_selected = $stmt_selected->get_result();
//         $gejala_dipilih = $result_selected->fetch_assoc()['count'];

//         // Hitung probabilitas menggunakan Teorema Bayes dan bobot gejala tertinggi
//         if ($total_gejala > 0) {
//             $probabilitas[$id_ph] = ($gejala_dipilih / $total_gejala) * $bobot_gejala_tertinggi;
//         } else {
//             $probabilitas[$id_ph] = 0;
//         }
//     }

//     // Tutup statement
//     $stmt_total->close();
//     $stmt_selected->close();

//     return $probabilitas;
// }


// // Fungsi untuk menjumlahkan nilai probabilitas
// function jumlahkan_probabilitas($probabilitas)
// {
//     return array_sum($probabilitas);
// }

// // Fungsi untuk mencari nilai hipotesis tanpa memandang audience
// function hipotesa_tanpa_audience($probabilitas)
// {
//     arsort($probabilitas);
//     return key($probabilitas);
// }

// // Fungsi untuk mencari nilai hipotesis dengan memandang audience
// function hipotesa_dengan_audience($probabilitas, $audience)
// {
//     if ($audience) {
//         // Logika tambahan untuk memandang audience (jika ada)
//         // Misalnya, berdasarkan preferensi atau kategori audience
//     }
//     arsort($probabilitas);
//     return key($probabilitas);
// }

// // Fungsi untuk mencari nilai P(H|E)
// function hitung_ph_given_e($probabilitas, $id_ph)
// {
//     return $probabilitas[$id_ph] ?? 0;
// }

// // Fungsi untuk menghitung nilai Bayes
// function hitung_nilai_bayes($probabilitas, $id_ph, $jumlah_probabilitas)
// {
//     if ($jumlah_probabilitas > 0) {
//         return ($probabilitas[$id_ph] / $jumlah_probabilitas);
//     } else {
//         return 0;
//     }
// }


// // Fungsi untuk melakukan diagnosis
// function old_diagnosa($id_diagnosa, $jenis_diagnosa, $tampilkan, $audience = null)
// {
//     global $koneksi;

//     // Ambil gejala berdasarkan ID diagnosa
//     $stmt = $koneksi->prepare("SELECT id_gejala FROM tb_detail_diagnosa WHERE id_diagnosa = ?");
//     if (!$stmt) {
//         die('Prepare failed: ' . $koneksi->error);
//     }
//     $stmt->bind_param("i", $id_diagnosa);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $id_gejala_dipilih = $result->fetch_all(MYSQLI_ASSOC);
//     $stmt->close();

//     // Jika tidak ada gejala ditemukan untuk ID diagnosa tersebut
//     if (empty($id_gejala_dipilih)) {
//         echo "Tidak ada gejala ditemukan untuk ID diagnosa yang diberikan.";
//         return;
//     }

//     // Mengambil data penyakit/hama yang relevan dengan gejala yang dipilih
//     $ids_ph = [];
//     $stmt = $koneksi->prepare("SELECT id_ph FROM tb_gejala_ph WHERE id_gejala = ?");
//     if (!$stmt) {
//         die('Prepare failed: ' . $koneksi->error);
//     }

//     foreach ($id_gejala_dipilih as $gejala) {
//         $id_gejala = $gejala['id_gejala'];
//         $stmt->bind_param("i", $id_gejala);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         $gejala_ph = $result->fetch_all(MYSQLI_ASSOC);

//         foreach ($gejala_ph as $ph) {
//             $ids_ph[] = $ph['id_ph'];
//         }
//     }
//     $stmt->close();

//     $id_gejala_dipilih_flat = array_column($id_gejala_dipilih, 'id_gejala');
//     $probabilitas_ph = hitung_probabilitas($ids_ph, $id_gejala_dipilih_flat);

//     // Menghitung total probabilitas
//     $jumlah_probabilitas = jumlahkan_probabilitas($probabilitas_ph);

//     // Mencari nilai hipotesis (tanpa audience)
//     $id_ph_tertinggi = hipotesa_tanpa_audience($probabilitas_ph);

//     // Mencari nilai hipotesis (dengan audience)
//     $id_ph_audience = hipotesa_dengan_audience($probabilitas_ph, $audience);

//     // Mencari nilai P(H|E)
//     $ph_given_e = hitung_ph_given_e($probabilitas_ph, $id_ph_tertinggi);

//     // Menghitung nilai Bayes
//     $nilai_bayes = hitung_nilai_bayes($probabilitas_ph, $id_ph_tertinggi, $jumlah_probabilitas);

//     // Menampilkan hasil dengan probabilitas tertinggi
//     $stmt = $koneksi->prepare("SELECT kode_ph, nama_ph FROM tb_ph WHERE id_ph = ?");
//     if (!$stmt) {
//         die('Prepare failed: ' . $koneksi->error);
//     }
//     $stmt->bind_param("i", $id_ph_tertinggi);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $row = $result->fetch_assoc();
//     $nama_ph = $row['nama_ph'];
//     $kode_ph = $row['kode_ph'];
//     $stmt->close();

//     $text = "<p>Berdasarkan Hasil Perhitungan dengan menggunakan metode Teorema Bayes, gejala yang dialami oleh tanaman jeruk, Maka Dapat Disimpulkan Nilai Tertinggi Dari perhitungan yang telah dilakukan adalah <b>$kode_ph</b> Yaitu $jenis_diagnosa <b>$nama_ph</b> Dengan Nilai Probabilitas " . number_format($ph_given_e, 4) . " Atau " . round($ph_given_e * 100) . '%' . " Dengan Kategori Pasti</p>";

//     if ($tampilkan == 'all') {
//         return $text;
//     } else if ($tampilkan == 'penyakit') {
//         return "$nama_ph";
//     } else if ($tampilkan == 'probality') {
//         return number_format($ph_given_e, 4);
//     } else if ($tampilkan == 'persentase') {
//         return round($ph_given_e * 100) . '%';
//     } else if ($tampilkan == 'id_ph') {
//         return encrypt($id_ph_tertinggi);
//     } else if ($tampilkan == 'id_ph_no_encrypt') {
//         return ($id_ph_tertinggi);
//     }
// }
