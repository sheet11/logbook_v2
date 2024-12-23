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
				<td align="left"><b><h4>Edit Data Absensi</b></h4></td>
			</tr>

			<tr>
				<td align="left"><b>Tingkat Keterlambatan (Menit)</b></td>
			</tr>

			<tr>
        		<td width="30%">1 s.d 30</td><td width="1%">:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
				<td>61 s.d 90</td><td>:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
        		<td>> 90</td><td>:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Total Tingkat Keterlambatan (Menit)</td><td>:</td>
				<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
				<td align="left"><b>Tingkat Pulang Sebelum Waktunya (Menit)</b></td>
			</tr>

			<tr>
        		<td>1 s.d 30</td><td>:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
				<td>61 s.d 90</td>
				<td width="1%">:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>

			<tr>
        		<td>> 90</td>
        		<td width="1%">:</td>
				<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Total Tingkat Pulang Sebelum Waktunya (Menit)</td>
        		<td width="1%">:</td>
				<td><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>


        	<tr>
        		<td>Tidak Ditempat Tugas (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Tidak Hadir (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Izin > 2 Hari (hari)</td>
        		<td width="1%">:</td>
        		<td><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

			<tr>
        		<td>Cuti </td>
        		<td width="1%">:</td>
        		<td><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>


			<tr>
				<td align="left"><b>Besaran Potongan</b></td>
			</tr>

			<tr>
        		<td>Hudis</td>
        		<td width="1%">:</td>
        		<td><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

			<tr>
        		<td>Absensi</td>
        		<td width="1%">:</td>
				<td><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>
				
			<tr>
				<td>Cuti</td>
				<td width="1%">:</td>
				<td><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
			</tr>
				
			<tr>
        		<td>PPK</td>
        		<td width="1%">:</td>
				<td><input type="text" placeholder="di input" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td><b>Total Potongan</b></td>
        		<td width="1%">:</td>
        		<td><input type="text" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Grade</td>
        		<td width="1%">:</td>
        		<td><input type="text" placeholder="data dari tb_pegawai" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Tunjangan 70%</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="data dari tb_pegawai" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>PIR</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="data dari tb_pegawai" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Jumlah Jam</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Besaran Tunjangan Kinerja Diterima</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Jumlah Potongan</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Besaran Tunjangan Kinerja Diterima setelah potongan</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>PPh 21</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="data dari tb_pegawai" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

        	<tr>
        		<td>Jumlah Potongan Pajak</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>

			<tr>
				<td>Jumlah Uang diterima</td>
        		<td width="1%">:</td>
        		<td ><input type="text" placeholder="otomatis" name="sakit" class="form-control"><?php echo "$a[sakit]"; ?></td>
        	</tr>   
			
			<tr>
				<td colspan="2"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
	</div>
</div>
