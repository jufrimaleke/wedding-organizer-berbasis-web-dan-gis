<?php 
error_reporting(0); 
include 'koneksi.php';

$kontak = mysqli_query($con, "SELECT no_hp, email, alamat FROM tb_admin WHERE id_admin = 1 ");
$a = mysqli_fetch_object($kontak);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>WO</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
						<li><a href="home">Beranda</a></li>
						<li><a href="product">Produk</a></li>
						<li><a href="#">Data Jasa wo</a></li>
						<li><a href="#">Registrasi wo</a></li>
						<li><a href="signin"><b>Login</b></a></li>
					</ul>
				</div>
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
			<h3>Produk</h3>
			<div class="box">
				<?php
				if ($_GET['search'] != '' || $_GET['kat']) {
						$where = "AND nama_produk LIKE '%".$_GET['search']."%' AND id_category LIKE '%".$_GET['kat']."%'";
					}

				$produk = mysqli_query($con, "SELECT * FROM tb_produk WHERE status_produk = 1 $where ORDER BY id_produk DESC ");
				if(mysqli_num_rows($produk) > 0){ 
					while($p = mysqli_fetch_array($produk)){

				?>	
					<a href="detail_produk.php?id=<?php echo $p['id_produk'] ?>">
					<div class="col-4">
						<img src="img/<?php echo $p['img_produk'] ?>" height="270px"width="50px">
						<p class="nama"><?php echo substr($p['nama_produk'], 0, 30); ?></p>
						<p class="harga"> Rp. <?php echo number_format($p['price_produk']); ?></p>	
					</div>
					</a>
				<?php }}else{?>
					<p>Tidak ada produk</p>
				<?php } ?>
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
			<small>Coppyright &copy; 2024 Wedding - Organizer</small>
		</div>
	</div>


</body>
</html>