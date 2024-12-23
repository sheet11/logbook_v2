<?php
include "session.php";
include "../config/koneksi.php";

	$id = 1;
	$status = $_POST['status'];
	
	$qr = mysql_query("UPDATE tb_pengaturan SET status_pengaturan='$status' WHERE id_pengaturan='$id'");
	if($qr)
	{
		echo "<script>alert('Status Pengisian SKP berhasil diperbarui.');window.location='01_atur_skp.php'</script>";
	}
	else
	{
		echo "<script>alert('Mohon maaf, Status Pengisian SKP gagal diperbarui.');window.location='01_atur_skp.php'</script>";
	}
?>