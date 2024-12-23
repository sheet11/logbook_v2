<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4"><b><h4>Tambah Data Perhitungan</b></h4></td>
			</tr>

			<tr>
        		<td>Total P2</td>
				<td><input type="text" name="p2" class="form-control"></td>
        	</tr>

			<tr>
        		<td>Standar Waktu</td>
				<td><input type="text" name="waktu" class="form-control"></td>
        	</tr>

        	<tr>
        		<td>Bulan dan Tahun</td>
				<td><select class="form-control" name="bulan">
					<?php for($bln = 1; $bln < 13 ;$bln++){
                        echo "<option value='$bln'>$bln</option>";
                    }?>
                    </select>
					<select class="form-control" name="tahun">
						<?php
							for($thn = (date('Y')-1);$thn <= date('Y');$thn++){
								echo "<option value='$thn'>$thn</option>";
							}
						?>
					</select>
				</td>
        	</tr>

        	<tr>
        		<td>Nama Pegawai</td>
				<td><select name='nip' class='form-control' >";
            <?php include "../config/koneksi.php";
        	$query = mysql_query("SELECT * FROM tb_pegawai ORDER BY id_pegawai ASC");
        	while ($row = mysql_fetch_array($query)) {
       		 echo"
        	<option value='$row[nip]'>$row[nama_lengkap]</option>
        	";
       		 }
        	?>
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
				$bulan = $_POST['bulan'];
				$tahun = $_POST['tahun'];
				$tanggal = $tahun.'-'.$bulan.'-01';
				
				$qr = mysql_query("SELECT * FROM tb_hitungan WHERE tanggal_hitungan='$tanggal' AND nip='$_POST[nip]'");
				$rq = mysql_num_rows($qr);
				
				if($rq>0)
				{
					echo"<script>alert('Data sudah ada, silahkan input kembali');window.location='09_tambah_perhitungan.php'</script>";
				}
				else
				{
					$query=mysql_query("insert into tb_hitungan(p2, standar_waktu, tanggal_hitungan, nip)
									values('$_POST[p2]','$_POST[waktu]','$tanggal','$_POST[nip]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='09_daftar_perhitungan.php'</script>";
					}
				}
				}				
		?>


 	
	</body>
</html>
