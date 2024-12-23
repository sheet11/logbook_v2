<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="6" class="info"><b>Tambah Data SKP</b></td>
			</tr>

			<tr>
        		<td width="25%"><b>Nama SKP</b></td>
        		<td width="2%">:</td>
				<td colspan="4"><textarea name="nama_skp" placeholder="Nama SKP" class="form-control"  required></textarea></td>
        	</tr>

			<tr>
        		<td><b>Uraian Kegiatan</b></td>
        		<td width="2%">:</td>
				<td colspan="4"><textarea name="uraian_pekerjaan" placeholder="Uraian Kegiatan" class="form-control" required></textarea></td>
        	</tr>

        	<tr>
				<td><b>Target Kegiatan/Tahun</b></td>
				<td width="2%">:</td>
				<td><input type="number" name="jumlah_kegiatan" class="form-control" required></td>
				<td><b>Output Kegiatan</b></td>
				<td width="2%">:</td>
				<td><select name="output_kegiatan" type="select" class="form-control" required>
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Dokumen">Dokumen </option>
					<option value="Kegiatan">Kegiatan</option>
					<option value="Exemplar">Exemplar</option>
	          		</select></td>
			</tr>

        	<tr>
        		<td><b>Alokasi Waktu Perhari</b></td>
        		<td width="2%">:</td>
				<td colspan="4"><input type="text" name="waktu" placeholder="Format Waktu : 00:00 (Jam:menit)" value="<?php echo "$a[waktu]"; ?>" class="form-control" required></td>
        	</tr>

			<tr>
				<td colspan="2">&nbsp;</td>
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
														
				$query=mysql_query("insert into tb_daftar_skp(nama_skp, uraian_pekerjaan,jumlah_kegiatan, output_kegiatan, waktu, nip)
									values('$_POST[nama_skp]','$_POST[uraian_pekerjaan]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','$_POST[waktu]','$_SESSION[nip]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='03_daftar_skp.php'</script>";
					}
				}					
		?>


 	
	</body>
</html>
