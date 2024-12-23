<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_logbook where id_logbook='$_GET[id_logbook]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="02_prosesedit_logbook_harian.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-hover">
			<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
			<input type="hidden" name="tanggal" value="<?php echo "$_GET[tanggal_awal]"; ?>">
			<tr>
				<td align="left" colspan="2"><b><h4>Edit Data Log Book</b></h4></td>
			</tr>

			<tr>
				<td width="20%">Tanggal Log Book</td>		
				<td colspan="4"><input type="date" id="tgls" name="tanggal_logbook" value="<?php echo "$a[tanggal_logbook]"; ?>" required="yes" class="form-control"> </td>
			</tr>

			<tr>
        		<td>Uraian Kegiatan</td>
        		<td colspan="4">
		        	<select name='uraian_pekerjaan' class='form-control' >";
		        	<option value="<?php echo $a['uraian_pekerjaan']; ?>"><?php echo $a['uraian_pekerjaan']; ?></option>
		            <?php include "../config/koneksi.php";
		        	$query = mysql_query("SELECT * FROM tb_daftar_skp WHERE nip='$_SESSION[nip]'");
		        	while ($row = mysql_fetch_array($query)) {
		       		 echo"
		        	<option value='$row[uraian_pekerjaan]'>$row[uraian_pekerjaan]</option>
		        	";
		       		 }
		        	?>
		        	echo"</select>
       		 	</td>
        	</tr>
			
			<tr><td>Jumlah Menit</td>	
				<td colspan="4"><input type="text" name="jumlah_menit" value="<?php echo "$a[jumlah_menit]"; ?>" required="yes" class="form-control"></td>
			</tr>
			
			<tr>
				<td>Kendala</td>	
				<td colspan="4"><textarea name="keterangan" class="form-control"><?php echo "$a[keterangan]"; ?></textarea></td>
			</tr>

			<tr>
				<td>Jumlah Kegiatan</td>
				<td><input type="text" name="jumlah_kegiatan" value="<?php echo "$a[jumlah_kegiatan]"; ?>" required="yes" class="form-control"></td>
				<td>Output Kegiatan</td>
				<td><select name="output_kegiatan" type="select" class="form-control">
	    			<option value="<?php echo "$a[output_kegiatan]"; ?>"><?php echo "$a[output_kegiatan]"; ?></option>
					<option value="Dokumen">Dokumen </option>
					<option value="Kegiatan">Kegiatan</option>
	          		</select></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td colspan="4"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Haanpus" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
	</div>
</div>
