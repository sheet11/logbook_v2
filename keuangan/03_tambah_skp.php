<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


		<table width="100%" class="table table-bordered">
			<tr>
				<td class="info" colspan="6"><b>Tambah Data SKP</b></td>
			</tr>

			<tr>			<form method="post" action="" enctype="multipart/form-data">        		<td width="25%"><b>Bulan</b></td>        		<td width="2%">:</td>				<td colspan="3"><input type="text" id="tglbln" name="bulan" required="yes" class="form-control"></td>				<td><input type="submit" name="proses" value="Proses" class="btn btn-danger"></td>        	</form>
        	</tr>	<form method="post" action="" enctype="multipart/form-data">	

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
			include"../config/koneksi.php";							if(isset($_POST['proses'])){					$tgl = $_POST['bulan'];					$tanggal = substr($tgl,8,2);					$bulan = substr($tgl,5,2);					$tahun = substr($tgl,0,4);					$query = mysql_query("SELECT status_pengaturan_skp FROM tb_pengaturan_skp WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_skp) = '$bulan' AND year(tanggal_pengaturan_skp) = '$tahun'");					$dapat = mysql_fetch_array($query);					if($dapat['status_pengaturan_skp'] == 'N')					{						echo"<script>alert('Mohon maaf Anda tidak bisa menambah SKP karena status sedang tidak aktif. Silahkan hubungi admin');window.location='03_tambah_skp.php'</script>"; 					}					elseif($dapat['status_pengaturan_skp'] == 'Y' OR empty($dapat))					{						echo"<script>alert('Proses Tanggal Berhasil');window.location='03_tambah_skp.php?tanggal=$_POST[bulan]'</script>"; 					}					else					{						echo"<script>alert('Error!!!');window.location='03_tambah_skp.php'</script>"; 					}									}
	
				if(isset($_POST['submit'])){					$tgl = $_POST['bulan'];					$tanggal = substr($tgl,8,2);					$bulan = substr($tgl,5,2);					$tahun = substr($tgl,0,4);					$query = mysql_query("SELECT status_pengaturan_skp FROM tb_pengaturan_skp WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_skp) = '$bulan' AND year(tanggal_pengaturan_skp) = '$tahun'");					$dapat = mysql_fetch_array($query);					if($dapat['status_pengaturan_skp'] == 'N')					{						echo"<script>alert('Mohon maaf Anda tidak bisa menambah SKP karena status sedang tidak aktif. Silahkan hubungi admin');window.location='03_tambah_skp.php'</script>"; 					}					elseif($dapat['status_pengaturan_skp'] == 'Y' OR empty($dapat))					{						$query=mysql_query("insert into tb_daftar_skp(nama_skp, uraian_pekerjaan,jumlah_kegiatan, output_kegiatan, waktu, nip)
									values('$_POST[nama_skp]','$_POST[uraian_pekerjaan]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','$_POST[waktu]','$_SESSION[nip]')");						if($query){							echo"<script>alert('Data Berhasil di Simpan');window.location='03_daftar_skp.php'</script>";						}					}					else					{						echo"<script>alert('Error!!!');window.location='03_tambah_skp.php'</script>"; 					}
				}					
		?>


 	
	</body>
</html>
