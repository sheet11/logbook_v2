<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


		<table width="100%" class="table table-bordered">
			<tr>
				<td class="info" colspan="6"><b>Tambah Data SKP</b></td>
			</tr>

			<tr>
        	</tr>

			<tr>
        		<td>Uraian Kegiatan</td>
        		<td>:</td>
				<td colspan="4"><input type="hidden" name="bulan" required="yes" class="form-control" value="<?php echo $_GET['tanggal']; ?>"><textarea name="uraian_pekerjaan" placeholder="Uraian Kegiatan" class="form-control" required></textarea></td>
        	</tr>

        	<tr>
				<td>Target Kegiatan/Tahun</td>
				<td width="2%">:</td>
				<td><input type="number" name="jumlah_kegiatan" class="form-control" required></td>
				<td>Output Kegiatan</td>
				<td width="2%">:</td>
				<td><select name="output_kegiatan" type="select" class="form-control" required>
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Dokumen">Dokumen </option>
					<option value="Kegiatan">Kegiatan</option>
					<option value="Exemplar">Exemplar</option>
	          		</select></td>
			</tr>

        	<tr>
        		<td>Alokasi Waktu Perhari</td>
        		<td>:</td>
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
									values('$_POST[nama_skp]','$_POST[uraian_pekerjaan]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','$_POST[waktu]','$_SESSION[nip]')");
				}					
		?>


 	
	</body>
</html>