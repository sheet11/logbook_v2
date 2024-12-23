<?php 	include"01_nav.php";
		include"../assets/js/date2.php";
		error_reporting(0); ?>
		
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4"><b><h4>Tambah Kehadiran</b></h4></td>
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
				<td><input type="hidden" name="nip" value="<?php echo $_SESSION['nip']; ?>"><input type="text" id="tglbln" name="tanggal_absensi" required="yes" class="form-control"></td>
        	</tr>
			
			<tr>
				<td align="left"><b>Tingkat Keterlambatan (Menit)</b></td>
			</tr>

			<tr>
        		<td width="30%">1 s.d 30</td><td width="1%">:</td>
				<td ><input type="number" placeholder="" name="terlambat1" class="form-control" required ></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat2" class="form-control" required ></td>
			</tr>

			<tr>
				<td>61 s.d 90</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat3" class="form-control" required ></td>
			</tr>

			<tr>
        		<td>> 90</td><td>:</td>
				<td ><input type="number" placeholder="" name="terlambat4" class="form-control" required ></td>
        	</tr>

        	<tr>
				<td align="left"><b>Tingkat Pulang Sebelum Waktunya (Menit)</b></td>
			</tr>

			<tr>
        		<td>1 s.d 30</td><td>:</td>
				<td ><input type="number" placeholder="" name="pulang1" class="form-control" required ></td>
			</tr>

			<tr>
        		<td>31 s.d 60</td><td>:</td>
				<td ><input type="number" placeholder="" name="pulang2" class="form-control" required ></td>
			</tr>

			<tr>
				<td>61 s.d 90</td>
				<td width="1%">:</td>
				<td ><input type="number" placeholder="" name="pulang3" class="form-control" required ></td>
			</tr>

			<tr>
        		<td>> 90</td>
        		<td width="1%">:</td>
				<td ><input type="number" placeholder="" name="pulang4" class="form-control" required ></td>
        	</tr>

        	<tr>
        		<td>Tidak Ditempat Tugas (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="number" placeholder="" name="tidakditempat" class="form-control" required ></td>
        	</tr>

        	<tr>
        		<td>Tidak Hadir (hari)</td>
        		<td width="1%">:</td>
        		<td ><input type="number" placeholder="" name="tidakhadir" class="form-control" required ></td>
        	</tr>

        	<tr>
        		<td>Izin > 2 Hari (hari)</td>
        		<td width="1%">:</td>
        		<td><input type="number" placeholder="" name="izin" class="form-control" required ></td>
        	</tr>

			<tr>
        		<td>Cuti </td>
        		<td width="1%">:</td>
        		<td><input type="number" placeholder="" name="cuti" class="form-control" required ></td>
        	</tr>


			<tr>
				<td align="left"><b>Besaran Potongan</b></td>
			</tr>

			<tr>
        		<td>Hudis</td>
        		<td width="1%">:</td>
        		<td><input type="number" step="any" placeholder="" name="hudis" class="form-control" required ></td>
        	</tr>
				
			<tr>
        		<td>PPK</td>
        		<td width="1%">:</td>
				<td><input type="number" placeholder="" name="ppk" class="form-control" required ></td>
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
						echo"<script>alert('Data Gagal di Simpan, Anda sudah mengisi absen di bulan dan tahun ini dengan pegawai yang sama.');window.location='06_tambah_absensi.php'</script>";
					}
					else
					{
						$query=mysql_query("INSERT INTO `tb_absensi`(`tanggal`, `terlambatsatu`, `terlambatdua`, `terlambattiga`, `terlambatempat`, `pulangsatu`, `pulangdua`, `pulangtiga`, `pulangempat`, `tidakditempat`, `tidakhadir`, `izin`, `cuti`, `hudis`, `ppk`, `nip`, `status`)
						VALUES ('$_POST[tanggal_absensi]',
						'$_POST[terlambat1]','$_POST[terlambat2]','$_POST[terlambat3]','$_POST[terlambat4]',
						'$_POST[pulang1]','$_POST[pulang2]','$_POST[pulang3]','$_POST[pulang4]',
						'$_POST[tidakditempat]','$_POST[tidakhadir]',
						'$_POST[izin]','$_POST[cuti]','$_POST[hudis]','$_POST[ppk]',
						'$_POST[nip]', 'Belum Di Nilai')");
						
						if($query){
							echo"<script>alert('Data Berhasil di Simpan');window.location='06_daftar_absensi.php'</script>";
						}
						else
						{
							echo"<script>alert('Data Gagal di Simpan');window.location='06_tambah_absensi.php'</script>";
						}
				}
					}					
		?>


 	
	</body>
</html>
