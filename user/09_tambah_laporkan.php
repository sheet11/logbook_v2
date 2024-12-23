<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4"><b><h4>Tambah Data Laporkan</b></h4></td>
			</tr>

			<tr>
        		<td>Laporan</td>
				<td><textarea name="nama_laporan" placeholder="Nama Laporkan" class="form-control" ></textarea></td>
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
														
				$query=mysql_query("insert into tb_laporkan(nama_laporan, nip)
									values('$_POST[nama_laporan]','$_SESSION[nip]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='09_daftar_laporkan.php'</script>";
					}
				}					
		?>


 	
	</body>
</html>
