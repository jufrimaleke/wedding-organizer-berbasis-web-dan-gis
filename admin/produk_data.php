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
		.btn4 {
		    padding: 12px 15px;
		    background-color: #00a65a;
		    color: #fff;
		    border: none;
		    cursor: pointer;
		    border-radius: 5px;
		    transition: transform 0.3s ease-in-out;
		}

		.btn4:hover {
		    transform: scale(1.1);
		}
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
			<h3>Data Produk</h3>
			<div class="box">
				<p><a href="tambah" class="btn4">Tambah Produk</a></p><br>
				<table border="1" cellpadding="0" class="tabel">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th >Penyedia Jasa (W.o)</th>
							<th>Kategori</th>
							<th>Nama Produk</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>Gambar</th>
							<th>Status</th>
							<th width="150px">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						$produk = mysqli_query($con, "SELECT * FROM tb_product INNER JOIN tb_category ON tb_category.category_id = tb_product.category_id INNER JOIN tb_wo ON tb_product.wo_id = tb_wo.wo_id ORDER BY tb_product.product_id DESC");

						if (mysqli_num_rows($produk) > 0) {
						while ($row = mysqli_fetch_array($produk)) {
						?>
						<tr>
							<td><?=$no++ ?></td>
							<td><?= $row['wo_name'] ?></td>
							<td><?= $row['category_name'] ?></td>
							<td><?= $row['product_name'] ?></td>
							<td>Rp. <?= number_format($row['product_price']) ?></td>
							<td><?= $row['product_description'] ?></td>
							<td>
								<a href="../img/<?php echo $row['product_image'] ?>" target="_blank"><img src="../img/<?php echo $row['product_image'] ?>" width="50"></a>
							</td>
							<td><?= ($row['product_status'] == 0)? 'Tidak aktif':'Aktif'; ?></td>
							<td>  
								<a href="edit?idp=<?php echo $row['product_id'] ?>">Edit</a> || <a href="hapus_produk.php?idp=<?php echo $row['product_id'] ?>" onclick="return confirm('Data akan dihapus?')">Hapus</a>
							</td>
						</tr>
					<?php }	}else{?>
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
	<footer>
		<div class="container">
			<small>Coppyright &copy; 2024 Wedding-Organizer.</small>
		</div>
	</footer>
	</footer>
	




</body>
</html>