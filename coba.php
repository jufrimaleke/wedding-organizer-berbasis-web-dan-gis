<?php 
session_start();
include 'koneksi.php';

if (isset($_SESSION['user'])) {
	echo "<script>window.location='admin/dashboard'</script>";
} elseif (isset($_SESSION['pelanggan'])) {
	echo "<script>window.location='pelanggan/dashboard'</script>";
}





$kontak = mysqli_query($con, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
$a = mysqli_fetch_object($kontak);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>Wedding-Organizer</title>
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
						<li></li>
					</ul>
				</div>
		</div>
	</header>


	<!-- search -->
	<div class="search">
		<div class="container">
			<form action="produk.php">
				<input type="text" name="search" placeholder="Cari Produk">
				<input type="submit" name="cari" value="Cari Produk">
			</form>
		</div>
	</div>

	<!-- category -->
	<div class="section">
		<div class="container">
			<h3>Kecamatan</h3>
			<div class="box">
				<?php 
					
					$kec = mysqli_query($con, "SELECT * FROM tb_kecamatan ORDER BY kecamatan_id DESC");
						if(mysqli_num_rows($kec) > 0){
						while($k = mysqli_fetch_array($kec)){

				?>	<a href="wo?kec_id=<?= $k['kecamatan_id']?>">
						<div class="col-5">
							<img src="img/kec.png" width="70px" style="margin-bottom: 5px;">
							<p><?= $k['kecamatan_name'] ?></p>
						</div>
					</a>
				<?php }}else{ ?>
					<p>Kategori tidak ada</p>
				<?php } ?>
			</div>
		</div>
	</div>

	<!-- new produk -->
	<div class="section">
		<div class="container">
			<h3>Pilihan Product/Paket</h3>
			<div class="box">
		
			<div class="cards">
				<?php 
				$produk = mysqli_query($con, "SELECT * FROM tb_product INNER JOIN tb_wo ON tb_product.wo_id = tb_wo.wo_id WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8 ");
				if(mysqli_num_rows($produk) > 0){ 
					while($p = mysqli_fetch_array($produk)){

				?>	

				<div class="cards">
				<a href="producd?idp=<?= $p['product_id'] ?>">
		        <article class="card">
		            <div class="card__preview">
		                <img src="img/<?php echo $p['product_image'] ?>">
		                <div class="card__price">
		                    Rp. <?php echo number_format($p['product_price']); ?>
		                </div>
		            </div>
		            <div class="card__content">
		                <h2 class="card__title"><?= $p['wo_name'] ?></h2>
		                <p class="card__address">
		                    <?php echo substr($p['product_name'], 0, 20) ; ?>
		                </p><br>
		                <div class="card__bottom">
		                    <div class="card__properties">
		                    	<button class="card__btn">
								<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
		                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
		                            stroke-linejoin="round">
		                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
		                            <path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
		                        </svg>
		                        </button><br>


		                    	<form method="POST"action="">
		                    		 <button name="add" class="btn3"><b>Add</b> 
			                    		<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
										    <!-- Basket Body -->
										    <path d="M3 5h18v16a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
										    <!-- Handle -->
										    <line x1="8" y1="10" x2="16" y2="10" />
										    <!-- Cart Bottom -->
										    <line x1="9" y1="19" x2="9" y2="21" />
										    <line x1="15" y1="19" x2="15" y2="21" />
										    <!-- Cart Wheels -->
										    <circle cx="9" cy="21" r="1" />
										    <circle cx="15" cy="21" r="1" />
										    <!-- Plus Sign -->
										    <line x1="12" y1="16" x2="12" y2="18" />
										    <line x1="11" y1="17" x2="13" y2="17" />
										</svg>
									</button>
		                    	</form>
		                    	<?php 

		                    	if (isset($_POST['add'])) {
		                    		if (!isset($_SESSION['user']) || !isset($_SESSION['pelanggan'])) {
		                    			echo "<script>alert('Anda belum login, Silahkan login terlebih dahulu!')</script>";
		                    			echo "<script>window.location='signin'</script>";
		                    		}
		                    	}

		                    	 ?>
		                        
		                    </div>

				
		                    
		                        
		                        <div class="rating" data-rating="5">
								  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="star">
								    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
								    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								  </svg>
								  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="star">
								    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
								    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								  </svg>
								  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="star">
								    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
								    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								  </svg>
								  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="star">
								    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
								    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								  </svg>
								  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="star">
								    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
								    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
								  </svg>
								  <!-- ... Repeat the SVG for each star ... -->
								</div>


		                   
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

	<!-- Pemetaan google maps -->
	
	

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<H4>Alamat</H4>
			<p><?= $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?= $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?= $a->admin_telp ?></p>
			<small>Coplyright &copy; 2024 - Wedding-Organizer.</small>
		</div>
	</div>

<script src="js/main.js"></script>
</body>
</html>