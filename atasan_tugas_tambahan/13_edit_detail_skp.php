<?php 
	include"01_nav.php";
	include"../assets/js/date2.php";
	error_reporting(0); 
?>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_detail_skp_dosen where id_detail_skp='$_GET[id_detail_skp]'");
	$a=mysql_fetch_array($query);
?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="13_prosesedit_detail_skp.php" enctype="multipart/form-data">	
			<table width="100%" class="table table-bordered">
				<input type="hidden" name="id_detail_skp" value="<?php echo "$a[id_detail_skp]"; ?>">
				<input type="hidden" name="bulan" value="<?php echo $_GET['bulan']; ?>">
				<input type="hidden" name="tahun" value="<?php echo $_GET['tahun']; ?>">
				<tr>
					<td align="left" colspan="6" class="info"><b>Edit Data Uraian SKP</b></td>
				</tr>

				<tr>
        			<td><b>Uraian Kegiatan</b></td>
        			<td width="2%">:</td>
					<td colspan="6"><textarea name="uraian_pekerjaan" placeholder="Uraian Kegiatan" class="form-control" required><?php echo $a['uraian_skp']; ?></textarea></td>
        		</tr>

        		<tr>
        			<td><b>Alokasi Waktu / Kegiatan</b></td>
        			<td width="2%">:</td>
					<td colspan="4"><input type="text" name="alokasi_waktu" class="form-control" required value="<?php echo $a['alokasi_waktu']; ?>"></td>
        		</tr>

        		<tr>
        			<td><b>Target Waktu / Bulan</b></td>
        			<td width="2%">:</td>
					<td colspan="4"><input type="text" name="target_waktu" class="form-control" required value="<?php echo $a['target_waktu']; ?>"></td>
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

