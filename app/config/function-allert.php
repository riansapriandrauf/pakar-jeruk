<script>
    function login_success() {
        swal.fire({
            title: "Selamat Anda Berhasil Login",
            text: "Selamat Datang Di Sistem Pakar Diagnosa Penyakit Jeruk",
            icon: "success",
            // button: true,
            showConfirmButton: false,
        });
        setTimeout(
            function() {
                window.location = "<?= url() ?>";
            },
            1500); // waktu tunggu atau delay
    }

    function berhasil_regis() {
        swal.fire({
            title: "Berhasil Buat Akun!",
            text: "Silahkan Login",
            icon: "success",
            showConfirmButton: false,
        });
        setTimeout(
            function() {
                window.location = "<?= url() ?>/login";
            },
            1500); // waktu tunggu atau delay
    }

    function user_ada() {
        swal.fire({
            title: "Maaf username yang anda masukkan!",
            text: "Sudah digunakan",
            icon: "info",
            showConfirmButton: false,
        });
    }

    function pw_salah() {
        swal.fire({
            title: "Password Salah!",
            text: "Maaf password yang anda masukkan salah!!!",
            icon: "error",
            button: true,
        });
    }

    function no_user() {
        swal.fire({
            title: "Username tidak terdaftar!",
            text: "Maaf username yang anda masukkan belum terdaftar!!!",
            icon: "error",
            button: true,
        });
    }

    function berhasil() {
        swal.fire({
            title: "Berhasil!",
            text: "Menyimpan data",
            icon: "success",
            button: true,
        });
    }

    function berhasil_kirim_notif() {
        swal.fire({
            title: "Berhasil Mengirim Notifikasi!",
            text: "Notifkasi Ke Whatsapp orang tua siswa telah berhasil dikirim",
            icon: "success",
            button: true,
        });
    }

    function lunas() {
        swal.fire({
            title: "Pembayaran Komite Siswa Telah Lunas",
            text: "Siswa ini telah melunasi pembayaran komite",
            icon: "success",
            button: true,
        });
    }

    function lebih_bayar() {
        swal.fire({
            title: "Pembayaran Komite Melebihi Rp.450.000",
            text: "Mohon Bayar sisa pembayaran siswa",
            icon: "info",
            button: true,
        });
    }

    function gagal() {
        swal.fire({
            title: "Gagal Menyimpan Data!",
            text: "Mohon periksa data anda",
            icon: "error",
            button: true,
        });
    }

    function kas_tidak_cukup() {
        swal.fire({
            title: "Maaf Kas anda tidak cukup",
            text: "Pengeluaran lebih besar dari jumlah kas yang tersisa",
            icon: "info",
            button: true,
        });
    }

    function double() {
        swal.fire({
            title: "Maaf Data Double!",
            text: "Maaf anda tidak dapat menginput data double",
            icon: "error",
            button: true,
        });
    }

    function gagal_file() {
        swal.fire({
            title: "Gagal Menyimpan File!",
            text: "Mohon periksa nama file anda",
            icon: "error",
            button: true,
        });
    }

    function ekstensi_salah() {
        swal.fire({
            title: "Gagal Menyimpan Data!",
            text: "Untuk menyimpan data mohon Upload file berekstensi : jpg / jpeg / png",
            icon: "error",
            button: true,
        });
    }

    function ukuran_besar() {
        swal.fire({
            title: "Gagal Menyimpan Data!",
            text: "Ukuran File anda melebihi 10MB",
            icon: "error",
            button: true,
        });
    }

    function berhasil_hapus() {
        swal.fire({
            title: "Berhasil Hapus Data",
            text: "Menghapus Data",
            icon: "success",
            html: "<br><button onclick='goBack()' class='btn btn-success'>OK</button>",
            showConfirmButton: false,
        });
        setTimeout(
            function() {
                window.history.back();
            },
            1000);
    }

    // KEMBALI KE PAGE SEBELUMNYA
    function goBack() {
        window.history.back();
    }
</script>