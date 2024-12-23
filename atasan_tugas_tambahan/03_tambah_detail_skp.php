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
					<input type="hidden" name="skp" value="<?php echo $_GET['id_daftar_skp']; ?>">
				</tr>

				<tr>
	        		<td><b>Uraian Kegiatan</b></td>
	        		<td width="2%">:</td>
					<td colspan="6"><textarea name="uraian_pekerjaan" placeholder="Uraian Kegiatan" class="form-control" required></textarea></td>
	        	</tr>

	        	<tr>
	        		<td><b>Alokasi Waktu / Kegiatan</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><input type="text" name="alokasi_waktu" class="form-control" required></td>
	        	</tr>

	        	<tr>
	        		<td><b>Target Waktu / Bulan</b></td>
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
					$query = mysql_query("SELECT status_pengaturan_skp FROM tb_pengaturan_skp WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_skp) = '$_POST[bulan]' AND year(tanggal_pengaturan_skp) = '$_POST[tahun]'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_skp'] == 'N')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah SKP karena status sedang tidak aktif. Silahkan hubungi admin');window.location='03_tambah_skp.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_skp'] == 'Y' OR empty($dapat))
					{
						$arr1 = explode(":", $_POST['alokasi_waktu']);
						$menit1 = $arr1[0]*60;
						$jam1 = $arr1[1];
						$tjam1 = $menit1 + $jam1;
						
						$arr2 = explode(":", $_POST['target_waktu']);
						$menit2 = $arr2[0]*60;
						$jam2 = $arr2[1];
						$tjam2 = $menit2 + $jam2;
						
						$query=mysql_query("insert into tb_detail_skp(uraian_skp, alokasi_waktu, alokasi_menit, target_waktu, target_menit, id_daftar_skp)
									values('$_POST[uraian_pekerjaan]','$_POST[alokasi_waktu]', '$tjam1','$_POST[target_waktu]', '$tjam2', '$_POST[skp]')");
						if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='03_skp_bulanan.php?bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
						}
						else
						{
							echo"<script>alert('Data Gagal di Simpan');window.location='03_tambah_detail_skp.php?id_daftar_skp=$_POST[skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>";
						}
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='03_tambah_detail_skp.php?id_daftar_skp=$_POST[skp]&bulan=$_POST[bulan]&tahun=$_POST[tahun]'</script>"; 
					}
				}					
		?>
	</body>
</html>

