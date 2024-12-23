<?php 
session_start();

//jika session nip belum dibuat, atau session nip kosong
if (!isset($_SESSION['nip']) || empty($_SESSION['nip'])) {
	//redirect ke halaman login
	header('location:index.php');
}
?>