<?php 
error_reporting(0); 
session_start();
include '../koneksi.php';

if (!isset($_SESSION['pelanggan'])) {
	echo "<script>window.location='".base_url()."'</script>";
}



$kontak = mysqli_query($con, "SELECT no_hp, email, alamat FROM tb_admin WHERE id_admin = 1 ");
$a = mysqli_fetch_object($kontak);
$kec = mysqli_query($con,"SELECT * FROM tb_kecamatan WHERE kecamatan_id = '".$_GET['kec_id']."'");
$d = mysqli_fetch_object($kec);

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
			<h1 class="home">
			    <a href="home" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 25px; font-weight: bold; background-image: linear-gradient(to right, #87CEEB, #00BFFF); -webkit-background-clip: text; color: transparent;">Wedding</a><a href="home" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px;  font-style: italic; background-image: linear-gradient(to right, #B0E57C, #7EC845); -webkit-background-clip: text; color: transparent; font-weight: bold; font-size: 39px;">Organizer</a>
			</h1>
			<div class="menu">
				<ul>
					<li><a href="dashboard">Beranda</a></li>
					<li><a href="product">Produk</a></li>
					<li><a href="#">Data Jasa wo</a></li>
					<li><a href="#">Keranjang</a></li> 
					<li><a href="#"><b>Welcome,  <?= $_SESSION['user_login'] ?></b></a></li> |
					<?php 
					if (isset($_SESSION['pelanggan'])) { ?>
						<li><a href="../logout.php"><b>LOGOUT</b></a></li>
					 <?php } ?>
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
			<h3>Daftar Wedding Organizer</h3> <p>Di Kecamatan - <?php echo $d->kecamatan_name ?> </p>
			<div class="box">
				<table border="1" cellpadding="0" class="tabel">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Foto</th>
							<th>Nama Wo</th>
							<th>Alamat</th>
							<th>Nomor Telepon</th>
							<th>Status</th>
							<th>Deskripsi</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
					    <?php
					    $no = 1;
					    $wo = mysqli_query($con, "SELECT * FROM tb_wo 
					        INNER JOIN tb_kecamatan ON tb_wo.kecamatan_id = tb_kecamatan.kecamatan_id 
					        WHERE tb_kecamatan.kecamatan_id = '".$_GET['kec_id']."' ORDER BY tb_wo.wo_id DESC");

					    if ($wo && mysqli_num_rows($wo) > 0) {
					        while ($row = mysqli_fetch_array($wo)) {
					    ?>
					            <tr>
					                <td><?= $no++ ?></td>
					                <td>
					                	<a href="../img/<?= $row['foto'] ?>"><img src="../img/<?= $row['foto'] ?>" width="50"></a>
					                </td>
					                <td><?= $row['wo_name'] ?></td>
					                <td><?= $row['wo_address'] ?></td>
					                <td><?= $row['wo_telp'] ?></td>
					                <td><?= ($row['status'] == 0) ? 'Tidak aktif' : 'Aktif'; ?></td>
					                <td><?= $row['deskripsi'] ?></td>
					                <td><a href="#">Kunjungi Disini</a></td>
					            </tr>
					    <?php }
					    } else { ?>
					        <tr>
					            <td colspan="8">Tidak ada data</td>
					        </tr>
					    <?php } ?>
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