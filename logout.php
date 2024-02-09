<?php
include 'koneksi.php';
session_start();
session_destroy();
unset($_SESSION['user']);
unset($_SESSION['pelanggan']);

echo "<script>window.location='home';</script>";
 ?>