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
	<script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

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
			<h3>Tambah WO</h3>
			<div class="box">
				<form method="POST" action="" enctype="multipart/form-data">
					<input type="text" name="nama" placeholder="Masukkan Nama wo" class="input-control" required>
					<input type="text" name="alamat" placeholder="Masukkan Alamat" class="input-control" required>
					<input type="text" name="notel" placeholder="Masukkan Nomor Telepon" class="input-control" required>
					<input type="text" name="lattitude" placeholder="Masukkan Lattitude" class="input-control" required>
					<input type="text" name="longittude" placeholder="Masukkan Longittude" class="input-control" required>
					<select class="input-control" name="kecamatan">
						<option>Pilih Kecamatan</option>
						<?php $query = mysqli_query($con, "SELECT * FROM tb_kecamatan"); 
						 foreach ($query as $kec) { ?>
						<option value="<?= $kec['kecamatan_id'] ?>"><?= $kec['kecamatan_name'] ?></option>
						 <?php } ?>	
					</select>
					<input type="text" name="username" placeholder="Masukkan Username" class="input-control" required>
					<input type="Password" name="password1" placeholder="Masukkan Password" class="input-control" required>
					<input type="Password" name="password2" placeholder="Ulangi Password" class="input-control" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="deskripsi"></textarea><br>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
					<input type="submit" name="submit" value="Tambah" class="btn3">
					<button class="btn2"><a href="wo" class="btn2">Batal</a></button>
				</form>
				<?php 

				if (isset($_POST['submit'])) {

					//print_r($_FILES['gambar']); fungsi ini menampilkan data-data yang akan diupload
					//menampung inputan dari form
					
					$nama 		= htmlspecialchars($_POST['nama']);
					$alamat 	= htmlspecialchars($_POST['alamat']);
					$notel	 	= htmlspecialchars($_POST['notel']);
					$lattitude 	= htmlspecialchars($_POST['lattitude']);
					$longittude	= htmlspecialchars($_POST['longittude']);
					$kecamatan 	= htmlspecialchars($_POST['kecamatan']);
					$username 	= htmlspecialchars($_POST['username']);
					$password1 	= htmlspecialchars($_POST['password1']);
					$password2 	= htmlspecialchars($_POST['password2']);
					$deskripsi 	= htmlspecialchars($_POST['deskripsi']);
					$status 	= htmlspecialchars($_POST['status']);

					//menampung data file yang diupload
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];

					//nama file baru
					$newname = 'paket'.time().'.'.$type2;

					//menampung data format file yang diizinkan
					$type_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

					//verifiaksi password
					if ($password1 !== $password2) {
						echo "
							<script>alert('Konfirmasi password tidak sesuai!');
							document.location.href = 'wotambah';
							</script>";
						return false;
					
					}
					//enkripsi passsword
					$pass = password_hash($password1, PASSWORD_DEFAULT);

					//validasi format file
					if (!in_array($type2, $type_diizinkan)) {
						echo "<script>alert('Format tidak diijinkan')</script>";
					}else {
						//jika format file sesuai dengan yang ada di dalam array tipe diijinkan
						// proses upload file sekaligus insert ke database
						move_uploaded_file($tmp_name, './../img/'.$newname);

						$insert = mysqli_query($con, "INSERT INTO tb_wo VALUES (
									null,
									'".$nama."',
									'".$alamat."',
									'".$notel."',
									'".$lattitude."',
									'".$longittude."',
									'".$kecamatan."',
									'".$username."',
									'".$pass."',
									'".$status."',
									'".$deskripsi."',
									'".$newname."')");
						if ($insert) {
							echo "<script>window.location='wo'</script>";
						}else {
							echo "data gagal disimpan" .mysqli_error($con);
						}
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

	<script>
            CKEDITOR.replace( 'deskripsi' );
    </script>




</body>
</html>
