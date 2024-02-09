
<?php

// Koneksi ke database
$con = mysqli_connect('localhost','root','','tokodiari');

$jufri = 'senja';

if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil semua data user dengan password MD5
$result = mysqli_query($con, "SELECT * FROM tb_wo WHERE wo_id = 1");

while ($row = mysqli_fetch_assoc($result)) {
    // Ubah password ke algoritma hash yang lebih aman
    $hashed_password = password_hash($jufri, PASSWORD_DEFAULT);

    // Perbarui password di database
    mysqli_query($con, "UPDATE tb_wo SET password = '$hashed_password' WHERE wo_id = {$row['wo_id']}");
}

// Tutup koneksi
mysqli_close($con);

echo "Konversi password selesai.";
?>
