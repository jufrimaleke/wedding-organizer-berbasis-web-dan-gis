<?php 

include "../../koneksi.php";
if (isset($_GET['idk'])) {
	$query = mysqli_query($con, "DELETE FROM tb_category WHERE id_category = '".$_GET['idk']."'" );
	echo "<script>window.location='data_kategori.php'</script>";
}

?>