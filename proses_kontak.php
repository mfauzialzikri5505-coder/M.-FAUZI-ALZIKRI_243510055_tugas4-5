<?php
include 'koneksi.php';

if (isset($_POST['kirim_pesan'])) {
    // 1. Ambil data form dan pangkas spasi kosong di awal/akhir menggunakan trim()
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $pesan = trim($_POST['pesan']);

    // 2. Terapkan Validasi & Pengamanan standar dari SQL Injection
    $nama = mysqli_real_escape_string($conn, $nama);
    $email = mysqli_real_escape_string($conn, $email);
    $pesan = mysqli_real_escape_string($conn, $pesan);

    // 3. Pastikan semua kolom benar-benar telah diisi (tidak kosong)
    if (!empty($nama) && !empty($email) && !empty($pesan)) {

        // 4. Jalankan perintah Query untuk menyimpan data ke tabel kontak
        $query = "INSERT INTO kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
        $simpan = mysqli_query($conn, $query);

        if ($simpan) {
            // jika berhasil disimpan, beri notifikasi alert javascript dan kembali ke halaman utama
            echo "<script>
                    alert('Pesan Anda berhasil dikirim dan tersimpan!');
                    window.location.href = 'pert4.php#contact';
                  </script>";
            exit();
        } else {
            // Jika query database gagal
            echo "<script>
                    alert('Gagal mengirim pesan. Silakan coba lagi.');
                    window.location.href = 'pert4.php#contact';
                  </script>";
            exit();
        }
    }
}
?>