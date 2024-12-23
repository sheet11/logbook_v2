<?php 
	include"01_nav.php";
	include "../assets/js/date.php";
	error_reporting(0); 
?>

<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#daftar").change(function(){
    var daftar = $("#daftar").val();
    $.ajax({
        url: "01_data_skp.php",
        data: "daftar="+daftar,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#detail").html(msg);
        }
    });
  });
});

</script>

<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_logbook as l, tb_daftar_skp as da, tb_detail_skp as de where l.id_daftar_skp=da.id_daftar_skp AND l.id_detail_skp=de.id_detail_skp AND id_logbook='$_GET[id_logbook]'");
	$a=mysql_fetch_array($query);
?>


<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="01_prosesedit_logbook.php" enctype="multipart/form-data">	
			<table width="100%" class="table table-hover">
				<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
				<tr>
					<td align="left" colspan="4" class="success"><b><h4>Edit Data Log Book</b></h4></td>
				</tr>

				<tr>
					<td width="20%">Tanggal Log Book</td>		
					<td colspan="4"><input type="text" id="tgls" name="tanggal_logbook" value="<?php echo "$a[tanggal_logbook]"; ?>" required="yes" class="form-control"> </td>
				</tr>

				<tr>
					<td width="20%">Nama SKP</td>		
					<td colspan="4">
						<select name="skp" id="daftar" class="form-control">
							<option value="<?php echo $a['id_daftar_skp']; ?>"><?php echo $a['nama_skp']; ?></option>
							<?php
								$daftar = mysql_query("select * from tb_daftar_skp where nip='$_SESSION[nip]' ORDER BY id_daftar_skp ASC");
								while($p=mysql_fetch_array($daftar))
								{
									echo "<option value=\"$p[id_daftar_skp]\">$p[nama_skp]</option>\n";
								}
							?>
						</select>
					</td>
				</tr>

				<tr>
					<td width="20%">Uraian SKP</td>		
					<td colspan="4">
						<select name="detail" id="detail" class="form-control">
							<option value="<?php echo $a['id_detail_skp']; ?>"><?php echo $a['uraian_skp']; ?></option>
						</select>
					</td>
				</tr>

	        	<tr>
					<td>Keterangan/Kendala Kegiatan</td>	
					<td colspan="4"><textarea name="keterangan" class="form-control"><?php echo "$a[keterangan]"; ?></textarea></td>
				</tr>

				<tr>
					<td>Jumlah Waktu</td>	
					<td colspan="4"><input type="text" name="jumlah_menit" value="<?php echo "$a[jumlah_menit]"; ?>" required="yes" class="form-control"></td>
				</tr>

				<tr>
					<td>Jumlah Kegiatan</td>
					<td><input type="text" name="jumlah_kegiatan" value="<?php echo "$a[jumlah_kegiatan]"; ?>" required="yes" class="form-control"></td>
					<td>Output Kegiatan</td>
					<td><select name="output_kegiatan" type="select" class="form-control">
		    			<option value="<?php echo "$a[output_kegiatan]"; ?>"><?php echo "$a[output_kegiatan]"; ?></option>
						<option value="Dokumen">Dokumen </option>
						<option value="Kegiatan">Kegiatan</option>
						<option value="Kegiatan">Exemplar</option>
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

