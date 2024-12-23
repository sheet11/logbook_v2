<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_daftar_skp where id_daftar_skp='$_GET[id_daftar_skp]'");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="03_prosesedit_skp.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<input type="hidden" name="id_daftar_skp" value="<?php echo "$a[id_daftar_skp]"; ?>">
			<tr>
				<td class="info" colspan="6"><b>Edit Data SKP</b></td>
			</tr>

			
			<tr>
        		<td width="25%">Nama SKP</td>
        		<td width="2%">:</td>
				<td colspan="4"><textarea name="nama_skp" class="form-control"><?php echo "$a[nama_skp]"; ?></textarea></td>
        	</tr>

			<tr>
        		<td>Uraian Kegiatan</td>
        		<td width="2%">:</td>
				<td colspan="4"><textarea name="uraian_pekerjaan" class="form-control"><?php echo "$a[uraian_pekerjaan]"; ?></textarea></td>
        	</tr>

        	<tr>
				<td>Target Kegiatan/Tahun</td>
				<td width="2%">:</td>
				<td><input type="text" name="jumlah_kegiatan" value="<?php echo "$a[jumlah_kegiatan]"; ?>" required="yes" class="form-control"></td>
				<td>Output Kegiatan</td>
				<td width="2%">:</td>
				<td><select name="output_kegiatan" type="select" class="form-control">
	    			<option value="<?php echo "$a[output_kegiatan]"; ?>"><?php echo "$a[output_kegiatan]"; ?></option>
					<option value="Dokumen">Dokumen </option>
					<option value="Kegiatan">Kegiatan</option>
					<option value="Examplar">Examplar</option>
	          		</select></td>
			</tr>

        	<tr>
        		<td>Alokasi Waktu/Hari</td>
        		<td width="2%">:</td>
				<td colspan="4"><input type="text" name="waktu" value="<?php echo "$a[waktu]"; ?>" class="form-control" ></td>
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
