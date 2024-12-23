<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_absensi where id_absensi='$_GET[id_absensi]'");
	$a=mysql_fetch_array($query);
	$pegawai = mysql_query("SELECT * from tb_pegawai where nip='$_GET[pegawai]'");
	$pg=mysql_fetch_array($pegawai);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="06_prosesedit_absensi.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<input type="hidden" name="id_absensi" value="<?php echo "$a[id_absensi]"; ?>">
			<input type="hidden" name="pegawai" value="<?php echo $_GET['pegawai']; ?>">
			<input type="hidden" name="bulan" value="<?php echo $_GET['bulan']; ?>">
			<input type="hidden" name="tahun" value="<?php echo $_GET['tahun']; ?>">
			<tr>
				<td align="left" colspan="4"><b><h4>Edit Kehadiran</b></h4></td>
			</tr>
			
			<tr>
				<td align="left"><b>Data Pegawai</b></td>
			</tr>
			
        	<tr>
        		<td>NIP</td><td width="1%">:</td>
				<td><?php echo $pg['nip'];?></td>
        	</tr>
			
        	<tr>
        		<td>Nama Pegawai</td><td width="1%">:</td>
				<td><?php echo $pg['nama_lengkap'];?></td>
        	</tr>
			
        	<tr>
        		<td>Unit Kerja</td><td width="1%">:</td>
				<td><?php echo $pg['unit_kerja'];?></td>
        	</tr>
			
        	<tr>
        		<td>Jabatan</td><td width="1%">:</td>
				<td><?php echo $pg['jabatan'];?></td>
        	</tr>
			
        	<tr>
        		<td>Tanggal </td><td width="1%">:</td>
				<td colspan="4"><input type="text" id="tgls" name="tanggal_absensi" required="yes" class="form-control" value="<?php echo $a['tanggal']; ?>"></td>
        	</tr>
			
			<tr>
        		<td>Keterlambatan</td><td>:</td>
				<td colspan="4"><input type="time" placeholder="" name="keterlambatan" class="form-control" value="<?php echo $a['keterlambatan']; ?>"></td>
        	</tr>

			<tr>
        		<td>Pulang Sebelum Waktunya </td><td>:</td>
				<td colspan="4"><input type="time" placeholder="" name="pulangsebelum" class="form-control" value="<?php echo $a['pulang_sebelum']; ?>"></td>
			</tr>

			<tr>
        		<td>Tidak Apel Pagi</td><td>:</td>
				<td colspan="4"><input type="checkbox" placeholder="" name="apelpagi" value="Y" <?php if($a['apel_pagi']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>

        	<tr>
        		<td>Tidak Apel Bersama</td><td>:</td>
				<td colspan="4"><input type="checkbox" placeholder="" name="apelbersama" value="Y" <?php if($a['apel_bersama']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>

        	<tr>
        		<td>Tidak Ditempat Tugas Tanpa Izin</td>
        		<td width="1%">:</td>
        		<td colspan="4"><input type="checkbox" placeholder="" name="tidakditempat" value="Y" <?php if($a['tidak_ditempat_tugas']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>

        	<tr>
        		<td>Tidak Hadir tanpa keterangan </td>
        		<td width="1%">:</td>
        		<td colspan="4"><input type="checkbox" placeholder="" name="tidakhadir" value="Y" <?php if($a['tidak_hadir']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>

        	<tr>
        		<td>Izin/Sakit</td>
        		<td width="1%">:</td>
        		<td colspan="4"><input type="checkbox" placeholder="" name="izin" value="Y" <?php if($a['izin_sakit']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>

			<tr>
        		<td>Cuti Diluar Cuti Tahunan</td>
        		<td width="1%">:</td>
        		<td><input type="checkbox" placeholder="" name="cuti" value="Y" <?php if($a['cuti']=='Y'){ echo checked;} else{echo "";} ?>>
        			Dari<input type="text" id="tgld" name="dari" value="<?php echo $a['cuti_dari']; ?>">
        			Sampai<input type="text" id="tglf" name="sampai" value="<?php echo $a['cuti_sampai']; ?>"></td>
        		<td>Jenis Cuti</td>
        		<td width="1%">:</td>
        		<td><select name="jeniscuti" type="select" class="form-control">
	    			<option value="<?php echo $a['jenis_cuti']; ?>"><?php echo $a['jenis_cuti']; ?></option>
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
        		<td colspan="4"><input type="checkbox" name="dl" value="Y" <?php if($a['dl_non_tusi']=='Y'){ echo checked;} else{echo "";} ?>></td>
        	</tr>   
			
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
	</div>
</div>
