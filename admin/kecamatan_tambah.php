<?php 
include "../koneksi.php";
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
			<h3>Tambah Data Kecamatan</h3>
			<div class="box">
				<form method="POST" action="">
					<input type="text" name="kecamatan" placeholder="Masukkan Kecamatan" class="input-control" required>
					<input type="submit" name="submit" value="Tambah" class="btn3">
					<button class="btn2"><a href="kecamatan">Batal</a></button>

				</form>
				<?php 

				if (isset($_POST['submit'])) {
					
					$nama = ucwords($_POST['kecamatan']);

					$insert = mysqli_query($con, "INSERT INTO tb_kecamatan VALUES (
						              null,
						              '".$nama."') ");
					if ($insert) {
						echo "<script>alert('Data berhasil ditambahkan')</script>";
						echo "<script>window.location='data_kecamatan.php'</script>";
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
