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
			<h3>Tambah Produk</h3>
			<div class="box">
				<form method="POST" action="" enctype="multipart/form-data">
					<select class="input-control" name="kategori">
						<option value="">--Pilih--</option>
						<?php 
						$kategori = mysqli_query($con, "SELECT * FROM tb_category ORDER BY category_id DESC");
						while($r = mysqli_fetch_array($kategori)) {
						?>
						<option value="<?= $r['category_id'] ?>"><?= $r['category_name'] ?></option>
						<?php } ?>
					</select>
					<select class="input-control" name="wo_id">
						<option value="">--Pilih--</option>
						<?php 
						$wo = mysqli_query($con, "SELECT * FROM tb_wo ORDER BY wo_id DESC");
						while($r = mysqli_fetch_array($wo)) {
						?>
						<option value="<?= $r['wo_id'] ?>"><?= $r['wo_name'] ?></option>
						<?php } ?>
					</select>
					<input type="text" name="nama" placeholder="Masukkan Nama Produk" class="input-control" required>
					<input type="text" name="harga" placeholder="Masukkan Harga" class="input-control" required>
					<input type="file" name="gambar" class="input-control" required>
					<textarea class="input-control" name="deskripsi" placeholder="deskripsi"></textarea><br>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>

					<input type="submit" name="submit" value="Tambah" class="btn3">
					<a href="produk" class="btn2">Batal</a>
				</form>
				<?php 

				if (isset($_POST['submit'])) {

					//print_r($_FILES['gambar']); fungsi ini menampilkan data-data yang akan diupload
					//menampung inputan dari form
					$kategori 	= $_POST['kategori'];
					$wo_id	    = $_POST['wo_id'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$deskripsi 	= $_POST['deskripsi'];
					$status 	= $_POST['status'];

					//menampung data file yang diupload
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					$type1 = explode('.', $filename);
					$type2 = $type1[1];

					//nama file baru
					$newname = 'produk'.time().'.'.$type2;

					//menampung data format file yang diizinkan
					$type_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

					//validasi format file
					if (!in_array($type2, $type_diizinkan)) {
						echo "<script>alert('Format tidak diijinkan')</script>";
					}else {
						//jika format file sesuai dengan yang ada di dalam array tipe diijinkan
						// proses upload file sekaligus insert ke database
						move_uploaded_file($tmp_name, './../img/'.$newname);

						$insert = mysqli_query($con, "INSERT INTO tb_product VALUES (
									null,
									'".$kategori."',
									'".$nama."',
									'".$harga."',
									'".$deskripsi."',
									'".$newname."',
									'".$status."',
									'".$wo_id."',
									null
										) ");
						if ($insert) {
							echo "<script>window.location='produk'</script>";
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
