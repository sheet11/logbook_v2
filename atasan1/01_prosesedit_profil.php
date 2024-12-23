<?php
include "session.php";
include "../config/koneksi.php";

	$nip = $_SESSION['nip'];
	$nama = $_POST['nama'];
	$pangkat = $_POST['pangkat'];
	$jabatan = $_POST['jabatan'];
	$unit_kerja = $_POST['unit_kerja'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	$nama_bank = $_POST['nama_bank'];
	$atas_nama = $_POST['atas_nama'];
	$no_rekening = $_POST['no_rekening'];
		// Untuk foto
		$nama_file = $_FILES['foto']['name'];
		$ukuran_file = $_FILES['foto']['size'];
		$tipe_file = $_FILES['foto']['type'];
		$tmp_file = $_FILES['foto']['tmp_name'];
		
		// Folder tempat menyimpan gambarnya
		$path = "../assets/foto/".$nama_file;
	
	if(empty($nama_file))
	{
		$qr = mysql_query("UPDATE tb_pegawai SET nama_lengkap='$nama', pangkat='$pangkat', jabatan='$jabatan', unit_kerja='$unit_kerja', alamat='$alamat', no_hp='$telepon', nama_bank='$nama_bank', atas_nama='$atas_nama', no_rekening='$no_rekening' WHERE nip='$nip'");
		if($qr)
		{
			echo "<script>alert('Data berhasil diperbarui, dengan tanpa merubah foto profil.');window.location='index.php'</script>";
		}
		else
		{
			echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='01_edit_profil.php'</script>";
		}
	}
	else
	{
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/gif" || $tipe_file == "image/jpg")
		{
			if($ukuran_file <= 1000000)
			{
				if(move_uploaded_file($tmp_file, $path))
				{
					$qr = mysql_query("UPDATE tb_pegawai SET nama_lengkap='$nama', pangkat='$pangkat', jabatan='$jabatan', unit_kerja='$unit_kerja', alamat='$alamat', no_hp='$telepon', foto_profil='$nama_file' WHERE nip='$nip'");
					if($qr)
					{
						echo "<script>alert('Data berhasil diperbarui.');window.location='index.php'</script>";
					}
					else
					{
						echo "<script>alert('Mohon maaf, data gagal diperbarui.');window.location='01_edit_profil.php'</script>";
					}
				}
				else
				{
					echo "<script>alert('Mohon maaf, Gambar gagal diupload.');window.location='01_edit_profil.php'</script>";
				}
			}
			else
			{
				echo "<script>alert('Mohon maaf, Gambar tidak boleh melebihi 1 Mb.');window.location='01_edit_profil.php'</script>";
			}
		}
		else
		{
			echo "<script>alert('Mohon maaf, type gambar yang diperbolehkan .jpg , .jpeg , .png , .gif');window.location='01_edit_profil.php'</script>";
		}
	}
?>