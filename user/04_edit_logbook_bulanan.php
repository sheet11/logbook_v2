<?php include"01_nav.php";
include "../assets/js/date.php";?>
<?php error_reporting(0); ?>

<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  $("#daftar").change(function(){
    var daftar = $("#daftar").val();
    $.ajax({
        url: "01_data_skp.php",
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
        url: "01_detail_skp.php",
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
	$query=mysql_query("select * from tb_logbook, tb_daftar_skp, tb_detail_skp where id_logbook='$_GET[id_logbook]' AND tb_logbook.id_daftar_skp=tb_daftar_skp.id_daftar_skp AND tb_logbook.id_detail_skp=tb_detail_skp.id_detail_skp");
	$a=mysql_fetch_array($query);
?>
	
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">	
		<table width="100%" class="table table-hover">
			<tr>
				<td align="left" colspan="2"><b><h4>Edit Data Log Book</b></h4></td>
			</tr>

		<form method="post" action="" enctype="multipart/form-data">
			<tr>
				<td width="20%">Tanggal Log Book</td>
			<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
			<input type="hidden" name="bulan" value="<?php echo "$_GET[bulan]"; ?>">
			<input type="hidden" name="tahun" value="<?php echo "$_GET[tahun]"; ?>">		
				<td colspan="2"><input type="date" id="tgls" name="tanggal" value="<?php echo "$_GET[tanggal]"; ?>" required="yes" class="form-control"> </td>
				<td colspan="2"><input type="submit" name="proses" value="Proses" class="btn btn-danger"></td>
			</tr>
			</form>
			
		<form method="post" action="04_prosesedit_logbook_bulanan.php" enctype="multipart/form-data">
			<tr>
				<td width="20%">Nama SKP</td>		
				<td colspan="4">
			<input type="hidden" name="id_logbook" value="<?php echo "$a[id_logbook]"; ?>">
			<input type="hidden" name="bulan" value="<?php echo "$_GET[bulan]"; ?>">
			<input type="hidden" name="tahun" value="<?php echo "$_GET[tahun]"; ?>">
			<input type="hidden" name="tanggal_logbook" value="<?php echo "$_GET[tanggal]"; ?>"> 
			<?php
						$tgl = $_GET['tanggal'];
						$tanggal = substr($tgl,8,2);
						$bulan = substr($tgl,5,2);
						$tahun = substr($tgl,0,4);
					?>
					<select name="skp" id="daftar" class="form-control">
						<option value="<?php echo $a['id_daftar_skp']; ?>"><?php echo $a['nama_skp']; ?></option>
						<option>--Pilih Nama SKP--</option>
						<?php
							$daftar = mysql_query("select * from tb_daftar_skp where nip='$_SESSION[nip]' AND month(bulan)='$bulan' AND year(bulan)='$tahun' ORDER BY id_daftar_skp ASC");
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
							$detail = mysql_query("SELECT * FROM tb_detail_skp ORDER BY id_detail_skp");
							while($p=mysql_fetch_array($detail)){
								echo "<option value=\"$p[id_detail_skp]\">$p[uraian_skp]</option>\n";
							}
						?>
					</select>
				</td>
			</tr>

			<tr>

				<td>Jumlah Kegiatan SKP</td>

				<td><input type="text" name="jumlah_kegiatan_skp" value="<?php echo "$a[jumlah_kegiatan_skp]"; ?>" required="yes" class="form-control"></td>

				<td>Output Kegiatan SKP</td>

				<td><select name="output_kegiatan_skp" type="select" class="form-control" required>

					<option value="<?php echo "$a[output_kegiatan_skp]"; ?>"><?php echo "$a[output_kegiatan]"; ?></option>

	    			<option value="">-- Silahkan Dipilih --</option>

					<option value="Dokumen">Dokumen </option>

	          		</select></td>

			</tr>

			<tr>
					<td>Jumlah Waktu</td>	
					<td colspan="4">
					<input type="text" name="jumlah_menit" class="form-control" value="<?php echo $a['jumlah_menit']; ?>" required>
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
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>
		</table>
	</form>
	</div>
</div>

<?php
if(isset($_POST['proses'])){
					echo"<script>alert('Proses Tanggal Berhasil');window.location='04_edit_logbook_bulanan.php?id_logbook=$_POST[id_logbook]&bulan=$_POST[bulan]&tahun=$_POST[tahun]&tanggal=$_POST[tanggal]'</script>"; 
					}
?>