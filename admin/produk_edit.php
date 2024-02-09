<?php 
include "../koneksi.php";
session_start();

if (!isset($_SESSION['user'])) {
	echo "<script>window.location='".base_url('admin')."'</script>";
}

$produk = mysqli_query($con, "SELECT * FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
if (mysqli_num_rows($produk) == 0) {
	echo "<script>window.location='produk'</script>";
}else{
$p = mysqli_fetch_object($produk);
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
			<h3>Edit Produk</h3>
			<div class="box">
				<form method="POST" action="" enctype="multipart/form-data">
					<select class="input-control" name="kategori">
						<option value="">--Pilih--</option>
						<?php 
						$produk = mysqli_query($con, "SELECT * FROM tb_category ORDER BY category_id DESC");
						while($r = mysqli_fetch_array($produk)) {
						?>
						<option value="<?= $r['category_id'] ?>" <?= ($r['category_id'] == $p->category_id)? 'selected':''; ?>><?= $r['category_name'] ?></option>
						<?php } ?>
					</select>
					<input type="text" name="nama" placeholder="Masukkan Nama Produk" class="input-control" value="<?= $p->product_name ?>" required>
					<input type="text" name="harga" placeholder="Masukkan Harga" class="input-control" value="<?= $p->product_price ?>" required>
					<img src="../img/<?= $p->product_image ?>" width="100px">
					<input type="hidden" name="foto" value="<?= $p->product_image ?>">
					<input type="file" name="gambar" class="input-control">
					<textarea class="input-control" name="deskripsi" placeholder="deskripsi"><?= $p->product_description ?></textarea><br>
					<select class="input-control" name="status">
						<option value="">--Pilih--</option>
						<option value="1" <?= ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
						<option value="0" <?= ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
					</select>

					<input type="submit" name="submit" value="Update" class="btn1">
					<a href="produk" class="btn2">Batal</a>
				</form>
				<?php 

				if (isset($_POST['submit'])) {

					//data inputan dari form
					$kategori 	= $_POST['kategori'];
					$nama 		= $_POST['nama'];
					$harga 		= $_POST['harga'];
					$deskripsi 	= $_POST['deskripsi'];
					$status 	= $_POST['status'];
					$foto 		= $_POST['foto'];

					// data gambar yang baru
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];

					
					//jika admin ganti gambar
					if ($filename != '') {

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'produk'.time().'.'.$type2;

						//menampung file yang diijinkan
						$tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');

						//validasi format file
						if (!in_array($type2, $tipe_diizinkan)) {
							//jika format file tidak ada didlm tipe diizinkan
							echo "<script>alert('format file tidak diijinkan')</script>";
						}else{
							unlink('./../img/'.$foto);
							move_uploaded_file($tmp_name, './../img/'.$newname);
							$namagambar = $newname; 
						}
					}else{
						//jika admin tidak ganti gambar
						$namagambar = $foto;
					}

					// query update data produk
					$update = mysqli_query($con, "UPDATE tb_product SET

										category_id = '".$kategori."',
										product_name = '".$nama."',
										product_price = '".$harga."',
										product_description = '".$deskripsi."',
										product_image = '".$namagambar."',
										product_status = '".$status."'
										WHERE product_id = '".$p->product_id."' ");
					if ($update) {
							echo "<script>alert('Ubah data berhasil')</script>";
							echo "<script>window.location='produk'</script>";
						}else {
							echo "Data gagal diupdate" .mysqli_error($con);
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
