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
					<td align="left" colspan="6" class="info"><b>Tambah Data Uraian SKP</b></td>
					<input type="hidden" name="bulan" value="<?php echo $_GET['bulan']; ?>">
					<input type="hidden" name="tahun" value="<?php echo $_GET['tahun']; ?>">
					<input type="hidden" name="pegawai" value="<?php echo $_GET['pegawai']; ?>">
					<input type="hidden" name="skp" value="<?php echo $_GET['id_daftar_skp']; ?>">
				</tr>

				<tr>
	        		<td><b>Uraian Kegiatan</b></td>
	        		<td width="2%">:</td>
					<td colspan="6"><textarea name="uraian_pekerjaan" placeholder="Uraian Kegiatan" class="form-control" required></textarea></td>
	        	</tr>

	        	<tr>
	        		<td><b>Alokasi Waktu Kegiatan</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><input type="text" name="alokasi_waktu" class="form-control" required></td>
	        	</tr>

	        	<tr>
	        		<td><b>Target Waktu Kegiatan</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><input type="text" name="target_waktu" class="form-control" required></td>
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
				$query=mysql_query("insert into tb_detail_skp(uraian_skp, alokasi_waktu, target_waktu, id_daftar_skp)
									values('$_POST[uraian_pekerjaan]','$_POST[alokasi_waktu]','$_POST[target_waktu]','$_POST[skp]')");
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='11_lihat_target_skp_pegawai.php?pegawai=$_POST[pegawai]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
					}
					else
					{
						echo"<script>alert('Data Gagal di Simpan');window.location='11_tambah_detail_target_skp_pegawai.php?pegawai=$_POST[pegawai]&id_daftar_skp=$_POST[skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
					}
				}					
		?>
	</body>
</html>

