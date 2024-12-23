<?php 
	include"01_nav.php";
	include "../assets/js/date.php";
	error_reporting(0); 
?>

<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  $("#daftar").change(function(){
    var daftar = $("#daftar").val();
    $.ajax({
        url: "12_data_skp.php",
        data: "daftar="+daftar,
        cache: false,
        success: function(msg){
            $("#detail").html(msg);
        }
    });
  });
  $("#detail").change(function(){
    var detail = $("#detail").val();
    $.ajax({
        url: "12_detail_skp.php",
        data: "detail="+detail,
        cache: false,
        success: function(msg){
            $("#waktu").html(msg);
        }
    });
  });
});
</script>


<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_logbook_dosen, tb_daftar_skp_dosen, tb_daftar_skp_dosen where id_logbook='$_GET[id_logbook]' AND tb_logbook_dosen.id_daftar_skp=tb_daftar_skp_dosen.id_daftar_skp AND tb_logbook_dosen.id_detail_skp=tb_daftar_skp_dosen.id_detail_skp");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="12_prosesedit_logbook_bulanan.php" enctype="multipart/form-data">	
			<table width="100%" class="table table-hover">
				<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
				<input type="hidden" name="bulan" value="<?php echo "$_GET[bulan]"; ?>">
				<input type="hidden" name="tahun" value="<?php echo "$_GET[tahun]"; ?>">
				<tr>
					<td align="left" colspan="2"><b><h4>Edit Data Log Book</b></h4></td>
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
							<option>--Pilih Nama SKP--</option>
							<?php
								$daftar = mysql_query("select * from tb_daftar_skp_dosen where nip='$_SESSION[nip]' ORDER BY id_daftar_skp ASC");
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
						<select name="detail" class="form-control" id="detail">
							<option value="<?php echo $a['id_detail_skp']; ?>"><?php echo $a['uraian_skp']; ?></option>
							<option>--Pilih Uraian SKP--</option>
							<?php
								$detail = mysql_query("SELECT * FROM tb_daftar_skp_dosen ORDER BY id_detail_skp");
								while($p=mysql_fetch_array($detail)){
									echo "<option value=\"$p[id_detail_skp]\">$p[uraian_skp]</option>\n";
								}
							?>
						</select>
					</td>
				</tr>

				<tr><td>Jumlah Waktu</td>	
					<td colspan="4">
						<span name="jumlah_menit" class="form-control" id="waktu" required ><?php echo $a['alokasi_waktu']; ?></span>
					</td>
				</tr>
				
				<tr>
					<td>Kendala</td>	
					<td colspan="4"><textarea name="keterangan" class="form-control"><?php echo $a['keterangan']; ?></textarea></td>
				</tr>

				<tr>
					<td>Jumlah Kegiatan</td>
					<td><input type="text" name="jumlah_kegiatan" value="<?php echo $a['jumlah_kegiatan']; ?>" required class="form-control"></td>
					<td>Output Kegiatan</td>
					<td><select name="output_kegiatan" type="select" class="form-control">
						<option value="<?php echo $a['output_kegiatan']; ?>"><?php echo $a['output_kegiatan']; ?></option>
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
