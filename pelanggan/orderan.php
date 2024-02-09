<?php 
session_start();

$id_order = $_GET['id'];

if (isset($_SESSION['keranjang_belanja'][$id_order])) {
	$_SESSION['keranjang_belanja'][$id_order]+=1;
}else{
	$_SESSION['keranjang_belanja'][$id_order]=1;
}

// echo "<pre>";
// 	print_r($_SESSION['keranjang_belanja']);
// echo "</pre>";


echo "<script>alert('Produk berhasil masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";



?>