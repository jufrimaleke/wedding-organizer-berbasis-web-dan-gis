<?php 
require_once "../koneksi.php";
session_start();

if (!isset($_SESSION['user'])) {
	echo "<script>window.location='".base_url('admin')."'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>WO</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap');
	</style>
</head>
<body>

	<header>
		<div class="container">
			<h1>
			    <a href="dashboard" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px; font-weight: bold; background-image: linear-gradient(to right, #87CEEB, #00BFFF); -webkit-background-clip: text; color: transparent;">W</a><a href="dashboard" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px;  font-style: italic; background-image: linear-gradient(to right, #B0E57C, #7EC845); -webkit-background-clip: text; color: transparent; font-weight: bold;">O</a>
			</h1>
			<ul>
				<li><a href="dashboard">Dashboard</a></li>
				<li><a href="profile">Profil</a></li>
				<li><a href="kategori">Data Kategori</a></li>
				<li><a href="produk">Data Produk</a></li>
				<li><a href="orderan">Orderan Masuk</a></li>
				<li><a href="pengguna">List Pengguna</a></li>
				<li><a href="kecamatan">Kecamatan</a></li>
				<li><a href="wo">List wo</a></li>
				<li><a href="../logout.php">Keluar</a></li>
			</ul>
		</div>
	</header>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Daftar Wo</h3>
			<div class="box">
				<p><a href="wotambah" class="btn4">Tambah WO</a></p><br>
				<table border="1" cellpadding="0" class="tabel">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Foto</th>
							<th>Nama Wo</th>
							<th>Alamat</th>
							<th>Nomor Telepon</th>
							<th>Kecamatan</th>
							<th>Username</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$wo = mysqli_query($con, "SELECT * FROM tb_wo INNER JOIN tb_kecamatan ON tb_wo.kecamatan_id = tb_kecamatan.kecamatan_id ORDER BY tb_wo.wo_id DESC");

						if (mysqli_num_rows($wo) > 0) {
						while ($row = mysqli_fetch_array($wo)) {
						?>
						<tr>
							<td><?=$no++ ?></td>
							<td>
								<a href="../img/<?= $row['foto'] ?>"><img src="../img/<?= $row['foto'] ?>" width="50"></a>
							</td>
							<td><?= $row['wo_name'] ?></td>
							<td><?= $row['wo_address'] ?></td>
							<td><?= $row['wo_telp'] ?></td>
							<td><?= $row['kecamatan_name'] ?></td>
							<td><?= $row['username'] ?></td>
							<td><?= ($row['status'] == 0)? 'Tidak aktif':'Aktif'; ?></td>
							<td>  
								<a href="woedit?idp=<?php echo $row['paket_id'] ?>">Edit</a> || <a href="hapus_paket.php?idp=<?php echo $row['paket_id'] ?>" onclick="return confirm('Data akan dihapus?')">Hapus</a>
							</td>
						</tr>
					<?php }	}else{?>
						<tr>
							<td colspan="9" class="btn4">Tidak ada data</td>
						</tr>

					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- footer -->
	<footer>
		<div class="container">
			<small>Coppyright &copy; 2024 Wedding-Organizer.</small>
		</div>
	</footer>




</body>
</html>