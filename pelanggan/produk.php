<?php 
session_start();
error_reporting(0); 
include '../koneksi.php';
if (!isset($_SESSION['pelanggan'])) {
	echo "<script>window.location='".base_url()."'</script>";
}
$kontak = mysqli_query($con, "SELECT * FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

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
			<h1 class="home">
			    <a href="home" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 25px; font-weight: bold; background-image: linear-gradient(to right, #87CEEB, #00BFFF); -webkit-background-clip: text; color: transparent;">Wedding</a><a href="home" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px;  font-style: italic; background-image: linear-gradient(to right, #B0E57C, #7EC845); -webkit-background-clip: text; color: transparent; font-weight: bold; font-size: 39px;">Organizer</a>
			</h1>



			<div class="menu">
					<ul>
						<li><a href="dashboard">Beranda</a></li>
						<li><a href="product">Produk</a></li>
						<li><a href="#">Data Jasa wo</a></li>
						<li><a href="#">Keranjang</a></li> 
						<li><a href="#"><b>Welcome,  <?= $_SESSION['user_login'] ?></b></a></li>   |
						<?php 
						if (isset($_SESSION['pelanggan'])) { ?>
							<li><a href="../logout.php"><b>LOGOUT</b></a></li>
						 <?php } ?>
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
				if (isset($_GET['search']) && isset($_GET['kat'])) {
				    $where = "AND product_name LIKE '%" . $_GET['search'] . "%' AND category_id LIKE '%" . $_GET['kat'] . "%'";
				} else {
				    $where = "";
				}

				$produk = mysqli_query($con, "SELECT * FROM tb_produk WHERE product_status = 1 $where ORDER BY product_id DESC ");
				if (mysqli_num_rows($produk) > 0) {
				    while ($p = mysqli_fetch_array($produk)) {
				        ?>
				        <a href="detail_produk.php?id=<?php echo $p['product_id'] ?>">
				            <div class="col-4">
				                <img src="../img/<?php echo $p['product_image'] ?>" height="270px" width="50px">
				                <p class="nama"><?php echo substr($p['product_name'], 0, 30); ?></p>
				                <p class="harga">Rp. <?php echo number_format($p['product_price']); ?></p>
				            </div>
				        </a>
				    <?php
				    }
				} else { ?>

				   

				<?php } ?>


				<div class="cards">
							<?php 
							$produk = mysqli_query($con, "SELECT * FROM tb_product INNER JOIN tb_wo ON tb_product.wo_id = tb_wo.wo_id WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8 ");
							if(mysqli_num_rows($produk) > 0){ 
								while($p = mysqli_fetch_array($produk)) { ?>	
					<div class="cards">
						<a href="producd?idp=<?= $p['product_id'] ?>">
					        <article class="card">
					            <div class="card__preview">
					                <img src="../img/<?php echo $p['product_image'] ?>">
					                <div class="card__price">
					                    Rp. <?php echo number_format($p['product_price']); ?>
					                </div>
					            </div>
					            <div class="card__content">
					                <h2 class="card__title"><?= $p['wo_name'] ?></h2>
					                <p class="card__address">
					                    <?php echo substr($p['product_name'], 0, 20) ; ?>
					                </p>
					                <p class="card__description">
					                    <?= $p['deskripsi'] ?>
					                </p>
					                <div class="card__bottom">
					                    <div class="card__properties">
					                        
		                    			<button class="btn3">Add Keranjang</button>
					                    </div>
					                    <button class="card__btn">
					                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
					                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
					                            stroke-linejoin="round">
					                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
					                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
					                        </svg>
					                    </button>
					                </div>
					            </div>
					        </article>
				        </a>
					</div>
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
			<p><?= $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?= $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?= $a->admin_telp ?></p>
			<small>Coppyright &copy; 2024 Wedding - Organizer</small>
		</div>
	</div>


</body>
</html>

