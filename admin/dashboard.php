<?php 
require_once "../koneksi.php";
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
	<!-- <div class="section">
		<div class="container">
			<h3>Dashboard</h3>
			<div class="box1">
				<h4>Selamat Datang, <b><?php echo $_SESSION['user_login']->admin_name ?></b> di Wedding Organizer Kepulauan Maluku Barat Daya</h4>
			</div>
            <div class="box1">
                
            </div>
		</div>
	</div> -->


    <div class="cards">
        <article class="card">
            <div class="card__preview">
                <img src="../img/lakeview-elegance.png" alt="Lakeview Elegance preview">
                <div class="card__price">
                    $4,750,000
                </div>
            </div>
            <div class="card__content">
                <h2 class="card__title">Lakeview Elegance</h2>
                <p class="card__address">
                    258 Serenity Lane, Crestwood Hills
                </p>
                <p class="card__description">
                    Nestled along the tranquil shores of a pristine lake, Lakeview Lakeside offers an idyllic escape
                    into nature's embrace.
                    This exquisite property combines rustic charm with modern luxury, featuring a spacious, elegantly
                    designed home with
                    panoramic lake views. Each room is crafted to maximize the connection with the natural surroundings,
                    offering large
                    windows and outdoor spaces that blend seamlessly with the serene lakeside setting.
                </p>
                <div class="card__bottom">
                    <div class="card__properties">
                        3 Bed | 2 Bath | 7,500 sq. ft
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
    </div>
























	<!-- footer -->
	<footer>
		<div class="container">
			<small>Coppyright &copy; 2024 Wedding-Organizer.</small>
		</div>
	</footer>

<script src="../js/main.js"></script>
</body>
</html>