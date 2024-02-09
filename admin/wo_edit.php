<?php 
include "../../koneksi.php";
session_start();

if (!isset($_SESSION['user'])) {
	echo "<script>window.location='".base_url()."'</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>WO</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
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
			<h3>Edit Data Kategori</h3>
			<div class="box">
				<?php 
				$query = mysqli_query($con, "SELECT * FROM tb_category WHERE id_category = '".$_GET['id']."' ");
				if (mysqli_num_rows($query) == 0) {
					echo "<script>window.location='data_kategori.php'</script>";
				}else {
				$data = mysqli_fetch_object($query);
				}
				?>
				<form method="POST" action="">
					<input type="text" name="kategori" value="<?= $data->nama_category ?>" class="input-control" required>
					<input type="submit" name="submit" value="Simpan" class="btnedit1">
					<a href="data_kategori.php" class="btnedit2">Batal</a>
				</form>
				<?php 

				if (isset($_POST['submit'])) {
					
					$nama = ucwords($_POST['kategori']);

					$update = mysqli_query($con, "UPDATE tb_category SET 
							nama_category = '".$nama."' 
							WHERE id_category = '".$_GET['id']."'");
					if ($update) {
						echo "<script>alert('Data berhasil diupdate')</script>";
						echo "<script>window.location='data_kategori.php'</script>";
					}else {
						echo "gagal".mysqli_error($con);
					}
				}


				?>


			</div>
		</div>
	</div>

	<!-- content -->
	<div class="section">
		<div class="container">
			
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
