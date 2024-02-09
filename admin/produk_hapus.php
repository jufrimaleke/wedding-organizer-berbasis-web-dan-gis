<?php 

include "../../koneksi.php";


if (isset($_GET['idp'])) {
	$produk = mysqli_query($con, "SELECT * FROM tb_produk WHERE id_produk = '".$_GET['idp']."' ");
	$p = mysqli_fetch_object($produk);

	unlink('./../../img/'.$p->img_produk);

	$delete = mysqli_query($con, "DELETE FROM tb_produk WHERE id_produk = '".$_GET['idp']."' ");
	echo "<script>window.location='data_produk.php'</script>";
}

?>