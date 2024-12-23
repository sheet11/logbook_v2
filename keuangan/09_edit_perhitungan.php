<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_hitungan where id_hitungan='$_GET[id_perhitungan]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="09_prosesedit_perhitungan.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-hover">
			<input type="hidden" name="id_hitungan" value="<?php echo "$a[id_hitungan]"; ?>">
			<input type="hidden" name="tanggal" value="<?php echo "$a[tanggal_hitungan]"; ?>">
			<tr>
				<td align="left" colspan="2"><b><h4>Edit Data Perhitungan</b></h4></td>
			</tr>

			<tr>
				<td width="20%">Total P2</td>		
				<td><input type="number" name="p2" value="<?php echo "$a[p2]"; ?>" required="yes" class="form-control"> </td>
			</tr>

			<tr>
				<td width="20%">Standar Waktu</td>		
				<td><input type="number" name="waktu" value="<?php echo "$a[standar_waktu]"; ?>" required="yes" class="form-control"> </td>
			</tr>

			<tr>
        		<td>Bulan dan Tahun</td>
        		<td>
		        	<select class="form-control" name="bulan">
					<?php
					$tanggal2 = $a['tanggal_hitungan'];
					$tgl2 = substr($tanggal2,8,2);
					$bln2 = substr($tanggal2,5,2);
					$thn2 = substr($tanggal2,0,4);
					?>
					<option value="<?php echo $bln2; ?>"><?php echo $bln2; ?></option>
					<?php for($bln = 1; $bln < 13 ;$bln++){
                        echo "<option value='$bln'>$bln</option>";
                    }?>
                    </select>
					<select class="form-control" name="tahun">
					<option value="<?php echo $thn2; ?>"><?php echo $thn2; ?></option>
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
				<td><select name='nip' class='form-control' >
				<?php include "../config/koneksi.php";
				$query = mysql_query("SELECT * FROM tb_pegawai WHERE nip='$a[nip]'");
				$qr = mysql_fetch_array($query);
				?>
					<option value="<?php echo $a['nip'] ?>"><?php echo $qr['nama_lengkap']; ?></option>
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
