<?php 
error_reporting(0); 
session_start();
include 'koneksi.php';

$kontak = mysqli_query($con, "SELECT no_hp, email, alamat FROM tb_admin WHERE id_admin = 1 ");
$a = mysqli_fetch_object($kontak);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>Wedding-Organizer</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap');
	</style>
</head>
<body>

	<header>
		<div class="container">
			<h1><a href="index.php">Wedding-Organizer</a></h1>
			<div class="menu">
				<ul>
					<li><a href="index.php">Beranda</a></li>
					<li><a href="produk.php">Produk</a></li>
					<li><a href="produk.php">Blog</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
		</div>
	</header>

	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
				<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	

	<!-- new produk -->
	<div class="section">
		<div class="container">
			<h3>Keranjang</h3>
			<div class="box">
				<h2>Keranjang Belanja</h2>
				<p>
					Anda mempunyai (4) items didalam keranjang belanja anda
				</p>
			</div>
		</div>
	</div>


	<div class="section">
		<div class="container">
			<h3>Data Produk</h3>
			<div class="box">
				<p><a href="tambah_produk.php " class="btn1">Tambah Produk</a></p><br>
				<table border="1" cellpadding="0" class="tabel">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Nama Produk/Paket</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>Gambar</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach ($_SESSION['keranjang_belanja'] as $id => $jumlah) :

						$ambil = mysqli_query($con, "SELECT * FROM tb_product")
						 ?>

						 <tr>
						 	<td></td>
						 	<td></td>
						 	<td></td>
						 	<td></td>
						 	<td></td>
						 	<td></td>
						 </tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>





	<!-- footer -->
	<div class="footer">
		<div class="container">
			<H4>Alamat</H4>
			<p><?= $a->alamat ?></p>

			<h4>Email</h4>
			<p><?= $a->email ?></p>

			<h4>No. Hp</h4>
			<p><?= $a->no_hp ?></p>
			<small>Coplyright &copy; 2022 - Tokodiari.</small>
		</div>
	</div>


</body>
</html>