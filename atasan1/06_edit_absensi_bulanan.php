<?php

	include"01_nav.php";

	include "../assets/js/date.php";

	error_reporting(0);

	$query = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$_GET[pegawai]'");

	$qr = mysql_fetch_array($query);
	
	$qry=mysql_query("select * from tb_absensi where id_absensi='$_GET[id_absensi]'");
	$a=mysql_fetch_array($qry);

?>
<div id="page-wrapper">

    <div class="container-fluid" style="margin:30px;">
<form method="post" action="06_prosesedit_absensi_bulanan.php" enctype="multipart/form-data">	

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

        	<tr><input type="hidden" name="id_absensi" value="<?php echo $_GET['id_absensi']; ?>">
			<input type="hidden" name="bulan" value="<?php echo "$_GET[bulan]"; ?>">
			<input type="hidden" name="pegawai" value="<?php echo "$_GET[pegawai]"; ?>">
			<input type="hidden" name="tahun" value="<?php echo "$_GET[tahun]"; ?>">

        		<td>Tanggal </td><td width="1%">:</td>

				<td colspan="4"><input type="text" id="tgls" name="tanggal_absensi" required="yes" class="form-control" value="<?php echo $a['tanggal']; ?>"></td>

        	</tr>

			


			<tr>

        		<td>Tidak Apel Pagi</td><td>:</td>

				<td colspan="4"><input type="checkbox" placeholder="" name="apelpagi" value="00:05" <?php if($a[apel_pagi] != "00:00:00"){ echo "checked";}else{ echo"";} ?>></td>

        	</tr>



        	<tr>

        		<td>Tidak Apel Bersama</td><td>:</td>

				<td colspan="4"><input type="checkbox" placeholder="" name="apelbersama" value="00:05" <?php if($a[apel_bersama] != "00:00:00"){ echo "checked";}else{ echo"";} ?>></td>

        	</tr>



        	<tr>

        		<td>Tidak Ditempat Tugas Tanpa Izin</td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="time" placeholder="" name="tidakditempat" class="form-control" value="<?php echo $a['tidak_ditempat_tugas']; ?>"></td>

        	</tr>



        	<tr>

        		<td>Tidak Hadir tanpa keterangan </td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="checkbox" placeholder="" name="tidakhadir" value="05:00" <?php if($a[tidak_hadir] != "00:00:00"){ echo "checked";}else{ echo"";} ?>></td>

        	</tr>



        	<tr>

        		<td>Izin/Sakit</td>

        		<td width="1%">:</td>

        		<td colspan="4"><input type="checkbox" placeholder="" name="izin" value="05:00" <?php if($a[izin_sakit] != "00:00:00"){ echo "checked";}else{ echo"";} ?>></td>

        	</tr>



			<tr>

        		<td>Cuti Diluar Cuti Tahunan</td>

        		<td width="1%">:</td>

        		<td><input type="checkbox" placeholder="" name="cuti" value="05:00" <?php if($a[cuti] != "00:00:00"){ echo "checked";}else{ echo"";} ?>>

        			Dari<input type="text" id="tgld" name="dari" value="<?php echo $a['cuti_dari']; ?>">

        			Sampai<input type="text" id="tglf" name="sampai" value="<?php echo $a['cuti_sampai']; ?>"></td>

        		<td>Jenis Cuti</td>

        		<td width="1%">:</td>

        		<td><select name="jeniscuti" type="select" class="form-control">

					<option value="<?php echo $a['jenis_cuti']; ?>"> <?php echo $a['jenis_cuti']; ?></option>

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

        		<td colspan="4"><input type="checkbox" name="dl" value="05:00" <?php if($a[dl_non_tusi] != "00:00:00"){ echo "checked";}else{ echo"";} ?>></td>

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