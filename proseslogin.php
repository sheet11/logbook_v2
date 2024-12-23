<?php
// memanggil file koneksi.php
include "config/koneksi.php";
// membuat variable dengan nilai dari form
$nip = $_POST['nip']; // variablenya = nip, dan nilainya sesuai yang dimasukkan di input name="nip" tadi
$password = ($_POST['password']); // variable password, dan nilainya sesuai yang dimasukkan di input name="password" tadi
// md5 ada sebuah fungsi PHP untuk engkripsi. misalnya admin jadi 21232f297a57a5a743894a0e4a801fc3. untuk lengkapnya, silahkan googling tentang md5
// proses untuk login

// menyesuaikan dengan data di database
$perintah = "select * from tb_pegawai WHERE nip = '$nip' AND password = '$password'";
$hasil = mysql_query($perintah);
$ada = mysql_num_rows($hasil);
$row = mysql_fetch_array($hasil);
if ($ada > 0) {
	if($row['level'] == "pegawai")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:user/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "penilai")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:penilai/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "administrator")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:administrator/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "keuangan")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:keuangan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "dosen_tugas_tambahan")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:dosen_tugas_tambahan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "dosen_murni")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:dosen_murni/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "atasan_tugas_tambahan")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:atasan_tugas_tambahan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	elseif($row['level'] == "atasan_menilai_dosen")
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:atasan_menilai_dosen/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

	else
	{
		session_start(); // memulai fungsi session
		$_SESSION['nip'] = $nip;
		$_SESSION['nama_lengkap'] = $row['nama_lengkap'];
		$_SESSION['unit_kerja'] = $row['unit_kerja'];
		$_SESSION['jabatan'] = $row['jabatan'];
		$_SESSION['grade'] = $row['grade'];
		$_SESSION['level'] = $row['level'];
		header("location:atasan/index.php"); // jika berhasil login, maka masuk ke file home.php
	}

}

else

{

	$perintah = "SELECT * FROM tb_user WHERE username = '$nip' AND password = '$password'";

	$hasil = mysql_query($perintah);

	$ada = mysql_num_rows($hasil);

	$row = mysql_fetch_array($hasil);

	if($ada > 0)

	{

		if($row['level'] == 'administrator')

		{

			session_start();

			$_SESSION['username'] = $row['username'];

			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];

			$_SESSION['level'] = $row['level'];

			header("location:administrator/index.php"); // jika berhasil login, maka masuk ke file home.php

		}

		elseif($row['level'] == 'verifikator1')

		{

			session_start();

			$_SESSION['username'] = $row['username'];

			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];

			$_SESSION['level'] = $row['level'];

			header("location:verifikator1/index.php"); // jika berhasil login, maka masuk ke file home.php

		}

		elseif($row['level'] == 'verifikator2')

		{

			session_start();

			$_SESSION['username'] = $row['username'];

			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];

			$_SESSION['level'] = $row['level'];

			header("location:verifikator2/index.php"); // jika berhasil login, maka masuk ke file home.php

		}

		elseif($row['level'] == 'atasan')

		{

			session_start();

			$_SESSION['username'] = $row['username'];

			$_SESSION['nama_lengkap'] = $row['nama_lengkap'];

			$_SESSION['level'] = $row['level'];

			header("location:atasan/index.php"); // jika berhasil login, maka masuk ke file home.php

		}

		else

		{

			echo "Gagal Masuk";

		}	

	}

	else

	{

		echo "Gagal Masuk";

	}	

}

?>