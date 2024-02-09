<?php 
include "../koneksi.php";
session_start();

if (!isset($_SESSION['user'])) {
	echo "<script>window.location='".base_url()."'</script>";
}

$query = mysqli_query($con, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."'");
$data = mysqli_fetch_object($query);
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
			<h3>Profile</h3>
			<div class="box">
				<form method="POST" action="">
					<input type="text" name="nama"class="input-control" value="<?php echo $data->admin_name ?>" required>
					<input type="text" name="user"class="input-control" value="<?php echo $data->username ?>" required>
					<input type="text" name="hp"class="input-control" value="<?php echo $data->admin_telp ?>" required>
					<input type="text" name="email"class="input-control" value="<?php echo $data->admin_email ?>" required>
					<input type="text" name="alamat"class="input-control" value="<?php echo $data->admin_address ?>" required>
					<input type="submit" name="submit" value="Ubah Profile" class="btn3">
				</form>

				<?php 
				if (isset($_POST['submit'])) {
				
			

				$nama = $_POST['nama'];
				$user = $_POST['user'];
				$hp = $_POST['hp'];
				$email = $_POST['email'];
				$alamat = $_POST['alamat'];

				$update = mysqli_query($con, "UPDATE tb_admin SET 
							nama_user = '".$nama."',
							username = '".$user."',
							no_hp = '".$hp."',
							email = '".$email."',
							alamat = '".$alamat."'
							WHERE id_admin = '".$d->id_admin."' ");

				if ($update) {
					echo "<script>alert('Data berhasil diubah')</script>";
					echo "<script>window.location='profile.php'</script>";
				}else {
					echo "gagal ". mysqli_error($con);
				}

			}

				?>

			</div>
		</div>
	</div>

	<!-- content -->
	<div class="section">
		<div class="container">
			<h3>Ubah Password</h3>
			<div class="box">
				<form method="POST" action="">
					<input type="Password" name="pass1" class="input-control" value="" required>
					<input type="Password" name="pass2" class="input-control" value="" required>
					<input type="submit" name="ubahpassword" value="Ubah Semua" class="btn3">
					<a href="dashboard" class="btn2">Batal</a>
				</form>

				<?php 
				if (isset($_POST['ubahpassword'])) {
				
			

				$pass1 = $_POST['pass1'];
				$pass2 = $_POST['pass2'];
				
				if ($pass2 != $pass1) {
					echo "<script>alert('Konfirmasi Password Tidak sesuai')</script>";
				}else{

				$update_pass = mysqli_query($con, "UPDATE tb_admin SET 
							password = '".md5($pass1)."',
							pass = '".$pass1."'
							WHERE id_admin = '".$d->id_admin."' ");

				if ($update_pass) {
					echo "<script>alert('Password berhasil diubah')</script>";
					echo "<script>window.location='profile.php'</script>";
				}else {
					echo "gagal ". mysqli_error($con);
				}

			}
			}

				?>

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
