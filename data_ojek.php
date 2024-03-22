<?php
// Lakukan koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "db_zippy"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari formulir
$nama = $_POST['nama'];
$lokasijemput = $_POST['lokasijemput'];
$lokasiantar = $_POST['lokasiantar'];
$catatan = $_POST['catatan'];
$totalBayar = $_POST['totalBayar']; // Ambil total bayar dari formulir POST

// Siapkan query SQL untuk menyimpan data
$sql = "INSERT INTO ojek_online (nama, lokasijemput, lokasiantar, catatan, total_bayar) VALUES ('$nama', '$lokasijemput', '$lokasiantar', '$catatan', '$totalBayar')";

if ($conn->query($sql) === TRUE) {
    // Bangun pesan WhatsApp
    $message = "Nama: " . urlencode($nama) . "%0A" .
               "Lokasi Jemput: " . urlencode($lokasijemput) . "%0A" .
               "Lokasi Antar: " . urlencode($lokasiantar) . "%0A" .
               "Catatan: " . urlencode($catatan) . "%0A" .
               "Total Bayar: " . urlencode($totalBayar);

    // Nomor WhatsApp yang dituju
    $whatsappNumber = "6283191290689"; // Ganti dengan nomor WhatsApp yang sesuai

    // Bangun URL WhatsApp
    $whatsappURL = "https://api.whatsapp.com/send?phone=" . $whatsappNumber . "&text=" . $message;

    // Redirect ke URL WhatsApp
    header("Location: " . $whatsappURL);
    exit; // Pastikan kode berhenti di sini untuk mencegah eksekusi lebih lanjut
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
