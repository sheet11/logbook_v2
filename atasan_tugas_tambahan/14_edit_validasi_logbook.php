<?php 
	include"01_nav.php";
	include "../assets/js/date.php";
	error_reporting(0); 
?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_logbook_dosen where id_logbook='$_GET[id_logbook]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="14_prosesedit_validasi_logbook.php" enctype="multipart/form-data">	
			<table width="100%" class="table table-hover">
				<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
				<input type="hidden" name="bulan" value="<?php echo "$_GET[bulan]"; ?>">
				<input type="hidden" name="tahun" value="<?php echo "$_GET[tahun]"; ?>">
				<input type="hidden" name="pegawai" value="<?php echo "$_GET[pegawai]"; ?>">
				<tr>
					<td align="left" colspan="2"><b><h4>Keterangan Dikembalikan</b></h4></td>
				</tr>

				<tr>
					<td width="20%">Keterangan Dikembalikan</td>		
					<td colspan="4"><textarea name="keterangan_status" required="yes" class="form-control"><?php echo "$a[keterangan_status]"; ?></textarea></td>
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