<?php
include "session.php";
include "../config/koneksi.php";

	$nip = $_SESSION['nip'];
	$pwd1 = $_POST['password1'];
	$pwd2 = $_POST['password2'];
	
	if($pwd1 == $pwd2)
	{
		$qr = mysql_query("UPDATE tb_pegawai SET password='$pwd1' WHERE nip='$nip'");
		if($qr)
		{
			echo "<script>alert('Password berhasil diperbarui.');window.location='index.php'</script>";
		}
		else
		{
			echo "<script>alert('Mohon maaf, password gagal diperbarui.');window.location='01_password.php'</script>";
		}
	}
	else
	{
		echo "<script>alert('Mohon maaf, Password tidak sama, harap ulangi dan pastikan passwordnya sama.');window.location='01_password.php'</script>";
	}
?>