<?php 
error_reporting(0); 
include 'koneksi.php';

$kontak = mysqli_query($con, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);


$produk = mysqli_query($con, "SELECT * FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
$p = mysqli_fetch_object($produk);


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

	
	<!-- produk detail -->
	<div class="section">
		<div class="container">
			<h3>Detail Produk</h3>
			<div class="box">
				<div class="col-2">
					<img src="img/<?php echo $p->product_image ?>" width="100%">	
				</div>
				<div class="col-2">
					<h3><?php echo $p->product_name; ?></h3>
					<h4>Rp. <?php echo number_format($p->product_price); ?></h4>
					<p>Deskripsi :<br>
						<?php echo $p->product_description; ?>
					</p>
					<p><a href="https://api.whatsapp.com/send?phone=<?= $a->admin_telp ?>&text=Hai, Saya tertarik dengan produk anda.
                    Nama Produk:
                    Rasa: 
                    Jumlah:
                    Alamat:
                    " target="_blank">
                    Hubungin Via Whatsapp <img src="img/wa.JPG" width="50px"></a>
                </p>	
				</div>

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