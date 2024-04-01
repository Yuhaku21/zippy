<?php
// Koneksi ke database
$servername = "localhost"; // Ganti sesuai dengan host database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_zippy"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$alamat = $_POST['lokasijemput'];
$catatan = $_POST['exampleComment'];

// Simpan data ke dalam tabel
$sql = "INSERT INTO homecare (nama, alamat, catatan) VALUES ('$nama', '$alamat', '$catatan')";

if ($conn->query($sql) === TRUE) {
    // Kirim pesan WhatsApp
    $whatsappNumber = '6283191290689'; // Ganti dengan nomor WhatsApp penerima

    // Pesan yang akan dikirimkan
    $message = "Nama: $nama\nAlamat: $alamat\nCatatan: $catatan";

    // Bangun URL untuk Click to Chat
    $waLink = "https://wa.me/$whatsappNumber/?text=" . urlencode($message);

    // Redirect pengguna ke link WhatsApp
    header("Location: $waLink");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
