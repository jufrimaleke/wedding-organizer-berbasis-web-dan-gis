<?php 
include 'koneksi.php';
session_start();
if (isset($_SESSION['user'])) {
	echo "<script>window.location='admin/dashboard';</script>";
} elseif (isset($_SESSION['pelanggan'])) {
	echo "<script>window.location='pelanggan/dashboard';</script>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device, initial-scale=1">
	<title>Login | WO</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap');
	</style>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body id="bg-login">
	<div class="box-login">
		<h2 style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px;  font-style: italic; background-image: linear-gradient(to right, #B0E57C, #7EC845); -webkit-background-clip: text; color: transparent; font-weight: bold; font-size: 39px;">Login
	
			    <a href="#" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 25px; font-weight: bold; background-image: linear-gradient(to right, #87CEEB, #00BFFF); -webkit-background-clip: text; color: transparent;">Wedding</a><a href="#" style="text-decoration: none; font-family: 'Arial', sans-serif; font-size: 32px;  font-style: italic; background-image: linear-gradient(to right, #B0E57C, #7EC845); -webkit-background-clip: text; color: transparent; font-weight: bold; font-size: 30px;">Organizer</a>
		</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control" required>
			<input type="password" name="pass" placeholder="Password" class="input-control" required>
			<input type="submit" name="login" value="Login" class="btn">
			<!-- <button class="btn3"><a href="registrasi">Registrasi</a></button> -->
		</form>

		<?php
   

    if (isset($_POST['login'])) {
        $user = trim(mysqli_real_escape_string($con, $_POST['user']));
        $pass = trim(mysqli_real_escape_string($con, $_POST['pass']));

        $cek_admin = mysqli_query($con, "SELECT * FROM tb_admin WHERE username = '$user'") or die(mysqli_error($con));

        if (mysqli_num_rows($cek_admin) === 1) {
            $data_admin = mysqli_fetch_assoc($cek_admin);
            if (password_verify($pass, $data_admin['password'])) {
                $_SESSION['user'] = $user;
                $_SESSION['user_login'] = $data_admin;
                $_SESSION['id'] = $data_admin['admin_id'];
                header("Location: admin/dashboard");
                exit();
            }
        }

        $cek_pelanggan = mysqli_query($con, "SELECT * FROM tb_pelanggan WHERE username = '$user'") or die(mysqli_error($con));

        if (mysqli_num_rows($cek_pelanggan) === 1) {
            $data_pelanggan = mysqli_fetch_assoc($cek_pelanggan);
            if (password_verify($pass, $data_pelanggan['password'])) {
                $_SESSION['user_login'] = $data_pelanggan['pelanggan_name'];
                header("Location: pelanggan/dashboard");
                exit();
            }
        }


        $cek_wo = mysqli_query($con, "SELECT * FROM tb_wo WHERE username = '$user'") or die(mysqli_error($con));

        if (mysqli_num_rows($cek_wo) === 1) {
            $data_wo = mysqli_fetch_assoc($cek_wo);
            if (password_verify($pass, $data_wo['password'])) {
                $_SESSION['user_login'] = $data_wo['wo_name'];
                $_SESSION['wo_id'] = $data_wo['wo_id'];
                header("Location: pelanggan/dashboard");
                exit();
            }
        }


        // Login Gagal
        echo "<div class='alert alert-danger alert-dismissable' role='alert'>
                <a href='#' class='close' data-dismiss='alert' arial-lable='close'>&times;</a>
                <span class='glyphicon glyphicon-exclamation-sign' arial-didden='true'></span>
                <strong>Login Gagal!</strong> Username / Password Salah    
              </div>";
    }
?>

	</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>