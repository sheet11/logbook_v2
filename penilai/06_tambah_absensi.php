

<?php

	include"01_nav.php";

	include "../assets/js/date.php";

	error_reporting(0);

	$query = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$_GET[pegawai]'");

	$qr = mysql_fetch_array($query);

?>





<div id="page-wrapper">

    <div class="container-fluid" style="margin:30px;">





	<form method="post" action="" enctype="multipart/form-data">	

		<table class="table table-bordered">   

                      <tr>

                          <td class="success" colspan="3"><b>Data Pegawai</b></td>

                      </tr>



                      <tr>

                          <td width="15%">NIP</td>

                          <td width="2%">:</td>

                          <td><?php echo $qr['nip'];?></td>

                      </tr>

                      <tr>

                          <td>Nama Pegawai</td>

                          <td width="2%">:</td>

                          <td><?php echo $qr['nama_lengkap'];?></td>

                      </tr>

                      <tr>

                          <td>Unit Kerja</td>

                          <td width="2%">:</td>

                          <td><?php echo $qr['unit_kerja'];?></td>

                      </tr>



                      <tr>

                          <td>Jabatan</td>

                          <td width="2%">:</td>

                          <td><?php echo $qr['jabatan'];?></td>

                      </tr>

        	<tr><input type="hidden" name="nip" value="<?php echo $_GET['pegawai']; ?>">

        		<td>Tanggal </td><td width="1%">:</td>

				<td colspan="4"><input type="text" id="tgls" name="tanggal_absensi" required="yes" class="form-control"></td>

        	</tr>

			

			<tr>

        		<td>Keterlambatan</td><td>:</td>

				<td colspan="4"><input type="time" placeholder="" name="keterlambatan" class="form-control"></td>

        	</tr>



			<tr>

        		<td>Pulang Sebelum Waktunya </td><td>:</td>

				<td colspan="4"><input type="time" placeholder="" name="pulangsebelum" class="form-control"></td>

			</tr>


				

			<tr>

				<td>&nbsp;</td>

				<td colspan="4"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">

					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>

			</tr>



		</table>      

	</form>



	</div>

</div>



		<?php

			include"../config/koneksi.php";

	

				if(isset($_POST['submit'])){

					$qr= mysql_fetch_array(mysql_query("SELECT * FROM tb_absensi WHERE tanggal = '$_POST[tanggal_absensi]' AND nip='$_POST[nip]'"));

					if($qr>1)

					{

						echo"<script>alert('Data Gagal di Simpan, Anda sudah mengisi absen di tanggal, bulan dan tahun ini dengan pegawai yang sama.');window.location='06_tambah_absensi.php'</script>";

					}

					else

					{

						$query=mysql_query("INSERT INTO `tb_absensi`(`tanggal`, `keterlambatan`, `pulang_sebelum`, `apel_pagi`, `apel_bersama`, `tidak_ditempat_tugas`, `tidak_hadir`, `izin_sakit`, `cuti`, `cuti_dari`, `cuti_sampai`, `jenis_cuti`, `dl_non_tusi`, `nip`, `status`)

						VALUES ('$_POST[tanggal_absensi]',

						'$_POST[keterlambatan]','$_POST[pulangsebelum]','$_POST[apelpagi]','$_POST[apelbersama]',

						'$_POST[tidakditempat]','$_POST[tidakhadir]','$_POST[izin]','$_POST[cuti]',

						'$_POST[dari]','$_POST[sampai]',

						'$_POST[jeniscuti]','$_POST[dl]',

						'$_POST[nip]', 'Belum Di Nilai')");

						

						if($query){

							echo"<script>alert('Data Berhasil di Simpan');window.location='06_input_daftar_absensi_semua_pegawai.php'</script>";

						}

						else

						{

							echo"<script>alert('Data Gagal di Simpan');window.location='06_tambah_absensi.php?pegawai=$_POST[nip]'</script>";

						}

				}

					}					

		?>





 	

	</body>

</html>

