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
		<table width="100%" class="table table-hover">
			<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
			<tr>
				<td align="left" colspan="2"><b><h4>Keterangan Dikembalikan</b></h4></td>
			</tr>

			<tr>
				<td width="20%">Keterangan Dikembalikan</td>		
				<td colspan="4"><textarea name="keterangan_atasan" required="yes" class="form-control"><?php echo "$a[keterangan_atasan]"; ?></textarea></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td colspan="4"><a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]'>
					            <button class='btn btn-info '><i class='glyphicon glyphicon-edit'></i></button>
					            </a>
					            
					            <a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
					            <button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></button>
					            </a></td>
			</tr>
		</table>

	<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_logbook where id_logbook='$_GET[id_logbook]'");
	$a=mysql_fetch_array($query);
?>

		<table width="100%" class="table table-hover">
			<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
			<tr>
				<td>&nbsp;</td>
				<td colspan="4"><a href='02_edit_logbook_harian.php?id_logbook=$a[id_logbook]'>
					            <button class='btn btn-info '><i class='glyphicon glyphicon-edit'></i></button>
					            </a>
					            
					            <a href='02_delete_logbook_harian.php?id_logbook=$a[id_logbook]' onclick='return confirm(\"Anda yakin akan menghapus $a[uraian_pekerjaan] ?\")'>
					            <button class='btn btn-danger'><i class='glyphicon glyphicon-remove'></i></button>
					            </a></td>
			</tr>
		</table>

	</div>
</div>
