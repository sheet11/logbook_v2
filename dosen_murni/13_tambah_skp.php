<?php 	
	include"01_nav.php";
	include"../assets/js/date2.php";
	error_reporting(0); 
?>

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
					<td align="left" colspan="6" class="info"><b>Tambah Data SKP</b></td>
				</tr>
				
				<tr>
	        		<td width="25%"><b>Bulan</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><input type="text" id="tglbln" name="bulan" required="yes" class="form-control"></td>
	        	</tr>

				<tr>
	        		<td width="25%"><b>Nama SKP</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><textarea name="nama_skp" placeholder="Nama SKP" class="form-control"  required></textarea></td>
	        	</tr>

	        	<tr>
					<td><b>Target </b></td>
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
					<td><b>Mutu </b></td>
					<td width="2%">:</td>
					<td colspan="4"><input type="number" placeholder="Mutu = 1-100" name="mutu" required="yes" class="form-control"></td>
				</tr>

				<tr>
					<td colspan="5">&nbsp;</td>
				</tr>

				<tr>
					<td colspan="6"><input type="submit" name="submit" value="Tambah" class="btn btn-danger">
						 <input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
				</tr>
			</table>      
		</form>
	</div>
</div>

		<?php
			include"../config/koneksi.php";
	
				if(isset($_POST['submit']))
				{
														
					$query=mysql_query("insert into tb_daftar_skp_dosen(bulan, nama_skp, target_kegiatan, output_kegiatan, mutu, nip, status)
										values('$_POST[bulan]','$_POST[nama_skp]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','$_POST[mutu]','$_SESSION[nip]', 'Belum Di Nilai')");
									
						if($query)
							{
								echo"<script>alert('Data Berhasil di Simpan');window.location='13_tambah_skp.php'</script>";
							}
						else
							{
								echo"<script>alert('Data Gagal di Simpan');window.location='13_tambah_skp.php'</script>";
							}
				}					
		?> 	
