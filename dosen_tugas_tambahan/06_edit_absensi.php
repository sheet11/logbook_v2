<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_absensi where id_absensi='$_GET[id_absensi]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="06_prosesedit_absensi.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<input type="hidden" name="id_absensi" value="<?php echo "$a[id_absensi]"; ?>">
			<tr>
				<td align="left" colspan="4"><b><h4>Edit Kehadiran</b></h4></td>
			</tr>
			
			<tr>
				<td align="left"><b>Data Pegawai</b></td>
			</tr>
			
        	<tr>
        		<td>NIP</td><td width="1%">:</td>
				<td><?php echo $_SESSION['nip'];?></td>
        	</tr>
			
        	<tr>
        		<td>Nama Pegawai</td><td width="1%">:</td>
				<td><?php echo $_SESSION['nama_lengkap'];?></td>
        	</tr>
			
        	<tr>
        		<td>Unit Kerja</td><td width="1%">:</td>
				<td><?php echo $_SESSION['unit_kerja'];?></td>
        	</tr>
			
        	<tr>
        		<td>Jabatan</td><td width="1%">:</td>
				<td><?php echo $_SESSION['jabatan'];?></td>
        	</tr>
			
        	<tr>
        		<td>Bulan & Tahun</td><td width="1%">:</td>
				<td><input type="hidden" name="id_absensi" value="<?php echo $a['id_absensi']; ?>"><input type="text" id="tglbln" name="tanggal_absensi" required="yes" class="form-control" value="<?php echo $a['tanggal']; ?>"></td>
        	</tr>

			<tr>
				<td align="left"><b>Tingkat Keterlambatan (Menit)</b></td>
			</tr>

			<tr>
        		<td width="30%">1 s.d 30</td><td width="1%">:</td>
				<td ><input type="number" placeholder="" name="terlambat1" class="form-control" required value="<?php echo $a['terlambatsatu']; ?>" ></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat2" class="form-control" required value="<?php echo $a['terlambatdua']; ?>" ></td>
			</tr>

			<tr>
				<td>61 s.d 90</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat3" class="form-control" required value="<?php echo $a['terlambattiga']; ?>" ></td>
			</tr>

			<tr>
        		<td>> 90</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat4" class="form-control" required value="<?php echo $a['terlambatempat']; ?>" ></td>
        	</tr>

        	<tr>
				<td align="left"><b>Tingkat Pulang Sebelum Waktunya (Menit)</b></td>
			</tr>

			<tr>
        		<td>1 s.d 30</td><td>:</td>
				<td ><input type="number" placeholder="" name="pulang1" class="form-control" required value="<?php echo $a['pulangsatu']; ?>" ></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="number" placeholder="" name="pulang2" class="form-control" required value="<?php echo $a['pulangdua']; ?>" ></td>
			</tr>

			<tr>
				<td>61 s.d 90</td>
				<td width="1%">:</td>
				<td ><input type="number" placeholder="" name="pulang3" class="form-control" required value="<?php echo $a['pulangtiga']; ?>" ></td>
			</tr>

			<tr>
        		<td>> 90</td>
        		<td width="1%">:</td>
				<td ><input type="number" placeholder="" name="pulang4" class="form-control" required value="<?php echo $a['pulangempat']; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Tidak Ditempat Tugas (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="number" placeholder="" name="tidakditempat" class="form-control" required value="<?php echo $a['tidakditempat']; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Tidak Hadir (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="number" placeholder="" name="tidakhadir" class="form-control" required value="<?php echo $a['tidakhadir']; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Izin > 2 Hari (hari)</td>
        		<td width="1%">:</td>
        		<td><input type="number" placeholder="" name="izin" class="form-control" required value="<?php echo $a['izin']; ?>" ></td>
        	</tr>

			<tr>
        		<td>Cuti </td>
        		<td width="1%">:</td>
        		<td><input type="number" placeholder="" name="cuti" class="form-control" required value="<?php echo $a['cuti']; ?>" ></td>
        	</tr>


			<tr>
				<td align="left"><b>Besaran Potongan</b></td>
			</tr>

			<tr>
        		<td>Hudis</td>
        		<td width="1%">:</td>
        		<td><input type="number" step="any" placeholder="" name="hudis" value="<?php echo $a['hudis']; ?>" class="form-control" required ></td>
        	</tr>
				
			<tr>
        		<td>PPK</td>
        		<td width="1%">:</td>
				<td><input type="number" placeholder="" name="ppk" value="<?php echo $a['ppk']; ?>" class="form-control" required ></td>
        	</tr>   
			
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
	</div>
</div>
