<?php 
	include"01_nav.php";
	include"../assets/js/date2.php";
	error_reporting(0); 
?>
<style>
.ui-datepicker-calendar 
	{
    	display: none;
    }
</style>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_daftar_skp_dosen where id_daftar_skp='$_GET[id_daftar_skp]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="13_prosesedit_skp.php" enctype="multipart/form-data">	
			<table width="100%" class="table table-bordered">
				<input type="hidden" name="id_daftar_skp" value="<?php echo "$a[id_daftar_skp]"; ?>">
				<tr>
					<td align="left" colspan="6" class="info"><b>Edit Data SKP</b><input type="hidden" name="bulan1" value="<?php echo $_GET['bulan']; ?>"><input type="hidden" name="tahun" value="<?php echo $_GET['tahun']; ?>"></td>
				</tr>
				
				<tr>
	        		<td width="25%"><b>Bulan</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><input type="text" id="tglbln" name="bulan" required="yes" class="form-control" value="<?php echo $a['bulan']; ?>"></td>
	        	</tr>
				
				<tr>
	        		<td width="25%"><b>Nama SKP</b></td>
	        		<td width="2%">:</td>
					<td colspan="4"><textarea name="nama_skp" class="form-control"><?php echo "$a[nama_skp]"; ?></textarea></td>
	        	</tr>

	        	<tr>
					<td><b>Target Kegiatan/Tahun</b></td>
					<td width="2%">:</td>
					<td><input type="text" name="jumlah_kegiatan" value="<?php echo "$a[target_kegiatan]"; ?>" required="yes" class="form-control"></td>
					<td><b>Output Kegiatan</b></td>
					<td width="2%">:</td>
					<td><select name="output_kegiatan" type="select" class="form-control">
		    			<option value="<?php echo "$a[output_kegiatan]"; ?>"><?php echo "$a[output_kegiatan]"; ?></option>
						<option value="SKS">SKS</option>

		          		</select></td>
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