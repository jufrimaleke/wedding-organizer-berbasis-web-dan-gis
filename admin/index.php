<?php
session_start();
require_once "../koneksi.php";
if (isset($_SESSION['user'])) {
echo "<script>window.location='".base_url('admin/dashboard.php')."';</script>";
} else {
echo "<script>window.location='".base_url()."';</script>";
}




?>