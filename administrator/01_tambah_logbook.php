<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4" class="success"><b><h4>Tambah Data Log Book</b></h4></td>
			</tr>

			<tr>
				<td width="20%">Tanggal Log Book</td>		
				<td colspan="4"><input type="text" id="tgls" name="tanggal_logbook" required="yes" class="form-control"> </td>
			</tr>

			<tr>
        		<td>Uraian Kegiatan</td>
        	<td colspan="4">
        	<select name='uraian_pekerjaan' class='form-control' >";
        	<option value="<?php echo $a['uraian_pekerjaan']; ?>"><?php echo $a['uraian_pekerjaan']; ?></option>
            <?php include "../config/koneksi.php";
        	$query = mysql_query("SELECT * FROM tb_daftar_skp WHERE nip='$_SESSION[nip]'");
        	while ($row = mysql_fetch_array($query)) {
       		 echo"
        	<option value='$row[id_daftar_skp]'>$row[uraian_pekerjaan]</option>
        	";
       		 }
        	?>
        	echo"</select>
       		 </td>
        	</tr>

        	<tr>
				<td>Keterangan / Kendala Kegiatan</td>	
				<td colspan="4"><textarea name="keterangan" class="form-control" required></textarea></td>
			</tr>
			
			<tr><td>Jumlah Waktu</td>	
				<td colspan="4"><input type="text" name="jumlah_menit" class="form-control" required></td>
			</tr>

			<tr>
				<td>Jumlah Kegiatan</td>
				<td><input type="text" name="jumlah_kegiatan" class="form-control" required></td>
				<td>Output Kegiatan</td>
				<td><select name="output_kegiatan" type="select" class="form-control" required>
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Dokumen">Dokumen </option>
					<option value="Kegiatan">Kegiatan</option>
					<option value="Kegiatan">Exemplar</option>
	          		</select></td>
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
					$qr = mysql_fetch_array(mysql_query("SELECT * FROM tb_daftar_skp WHERE id_daftar_skp = '$_POST[uraian_pekerjaan]'"));
					$jumenit = substr($qr['waktu'], 0, 5);
					if($_POST['jumlah_menit'] > $qr['waktu'])
					{
						echo"<script>alert('Data Gagal di Simpan, waktu yang diperbolehkan sama/kurang dari $jumenit');window.location='01_tambah_logbook.php'</script>";
					}
					else
					{
						$query=mysql_query("insert into tb_logbook(tanggal_logbook, uraian_pekerjaan, jumlah_menit, keterangan, jumlah_kegiatan,output_kegiatan, status_atasan,status_penilai, nip)
									values('$_POST[tanggal_logbook]','$qr[uraian_pekerjaan]','$_POST[jumlah_menit]','$_POST[keterangan]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','Belum di Verifikasi', 'Belum di Verifikasi', '$_SESSION[nip]')");
						if($query){
							echo"<script>alert('Data Berhasil di Simpan');window.location='01_logbook.php'</script>";
						}
						else
						{
							echo"<script>alert('Data Gagal di Simpan');window.location='01_tambah_logbook.php'</script>";
						}
					}
				}					
		?>


 	
	</body>
</html>
