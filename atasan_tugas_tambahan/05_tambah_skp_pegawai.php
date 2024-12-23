<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4"><b><h4>Tambah Data SKP Pegawai</b></h4></td>
			</tr>

			<tr>
        		<td>Uraian Kegiatan</td>
				<td><textarea name="uraian_pekerjaan" class="form-control"></textarea></td>
        	</tr>

        	<tr>
        		<td>Waktu</td>
				<td><input type="text" name="waktu" class="form-control"></td>
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
														
				$query=mysql_query("insert into tb_daftar_skp(uraian_pekerjaan, waktu,  nip)
									values('$_POST[uraian_pekerjaan]','$_POST[waktu]','$_GET[pegawai]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='05_lihat_skp_semua_pegawai.php'</script>";
					}
				}					
		?>


 	
	</body>
</html>
