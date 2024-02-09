<?php 
// setting default timezone
date_default_timezone_set('asia/jakarta');



//koneksi
$con = mysqli_connect('localhost','root','','tokodiari');
if (mysqli_connect_errno()) {
	echo mysqli_connect_error();
}


//fungsi base_url
function base_url($url = null) {
	$base_url = "localhost/siswedding";
	if ($url != null) {
		return $base_url."/".$url;
	} else {
		return $base_url;
	}
}







?>