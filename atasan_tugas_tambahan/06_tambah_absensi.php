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

        		<td>Tidak Apel Pagi</td><td>:</td>

				<td colspan="4"><input type="checkbox" placeholder="" name="apelpagi" value="00:05"></td>

        	</tr>



        	<tr>

        		<td>Tidak Apel Bersama</td><td>:</td>

				<td colspan="4"><input type="checkbox" placeholder="" name="apelbersama" value="00:05"></td>

        	</tr>



        	<tr>

        		<td>Tidak Ditempat Tugas Tanpa Izin</td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="time" placeholder="" name="tidakditempat" class="form-control"></td>

        	</tr>



        	<tr>

        		<td>Tidak Hadir tanpa keterangan </td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="checkbox" placeholder="" name="tidakhadir" value="05:00"></td>

        	</tr>



        	<tr>

        		<td>Izin/Sakit</td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="checkbox" placeholder="" name="izin" value="05:00"></td>

        	</tr>



			<tr>

        		<td>Cuti Diluar Cuti Tahunan</td>

        		<td width="1%">:</td>

        		<td><input type="checkbox" placeholder="" name="cuti" value="05:00">

        			Dari<input type="text" id="tgld" name="dari">

        			Sampai<input type="text" id="tglf" name="sampai"></td>

        		<td>Jenis Cuti</td>

        		<td width="1%">:</td>

        		<td><select name="jeniscuti" type="select" class="form-control">

	    			<option value="">-- Silahkan Dipilih --</option>

					<option value="Cuti Bersama"> Cuti Bersama</option>

					<option value="Cuti Bersalin">Cuti Bersalin</option>

					<option value="Cuti Alasan Penting">Cuti Alasan Penting</option>

					<option value="Cuti Sakit">Cuti Sakit</option>

	          		</select>

        		</td>

        	</tr>



			<tr>

        		<td>DL Non Tusi</td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="checkbox" name="dl" value="05:00"></td>

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

						$query=mysql_query("INSERT INTO `tb_absensi`(`tanggal`, `apel_pagi`, `apel_bersama`, `tidak_ditempat_tugas`, `tidak_hadir`, `izin_sakit`, `cuti`, `cuti_dari`, `cuti_sampai`, `jenis_cuti`, `dl_non_tusi`, `nip`, `status`)

						VALUES ('$_POST[tanggal_absensi]','$_POST[apelpagi]','$_POST[apelbersama]',

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

