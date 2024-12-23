<?php 	
	include"01_nav.php";
	include"../assets/js/date.php";
	error_reporting(0); 
?>

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
});
</script>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4" class="success"><b><h4>Tambah Data Log Book</b></h4></td>
			</tr>

			<tr>
				<td width="20%">Tanggal Log Book</td>		
				<td colspan="4"><input type="text" id="tgls" name="tanggal_logbook" required="yes" class="form-control"> </td>
			</tr>

			<tr>
				<td width="20%">Nama SKP</td>		
				<td colspan="4">
					<select name="skp" id="daftar" class="form-control">
						<option>--Pilih Nama SKP--</option>
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
				<td>Jumlah Kegiatan SKP</td>
				<td><input type="number" name="jumlah_kegiatan_skp" class="form-control"></td>
				<td>Output Kegiatan SKP</td>
				<td><select name="output_kegiatan_skp" type="select" class="form-control">
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Dokumen">Dokumen </option>
	          		</select></td>
			</tr>

			<tr>
				<td width="20%">Uraian SKP</td>		
				<td colspan="4">
					<select name="detail" class="form-control" id="detail">
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

			<tr><td>Jumlah Waktu</td>	
				<td colspan="4">
					<input type="text" name="waktu" class="form-control" required>
				</td>
			</tr>

			<tr>
				<td>Jumlah Kegiatan</td>
				<td><input type="number" name="jumlah_kegiatan" class="form-control" required></td>
				<td>Output Kegiatan</td>
				<td><select name="output_kegiatan" type="select" class="form-control" required>
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="Kegiatan">Kegiatan</option>
	          		</select></td>
			</tr>

			<tr>
				<td>Keterangan / Kendala Kegiatan</td>	
				<td colspan="4"><textarea name="keterangan" class="form-control" ></textarea></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td colspan="4"><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>

		</table>      
	</form>

	<table> 
		<tr>
			<td><b>Keterangan :</b></td>
			<td>Jumlah Kegiatan SKP dan Output Kegiatan SKP diisi apbila SKP telah mencapati 1 Document </td>
			
		</tr>
		
	</table>

	</div>
</div>

		<?php
			include"../config/koneksi.php";
				if(isset($_POST['proses']))
				{
					$tgl = $_POST['tanggal'];
					$tanggal = substr($tgl,8,2);
					$bulan = substr($tgl,5,2);
					$tahun = substr($tgl,0,4);
					$query = mysql_query("SELECT status_pengaturan_logbook FROM tb_pengaturan_logbook WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_logbook) = '$bulan' AND year(tanggal_pengaturan_logbook) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_logbook'] == 'N')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah Logbook karena status sedang tidak aktif. Silahkan hubungi admin');window.location='01_tambah_logbook.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_logbook'] == 'Y' OR empty($dapat))
					{
						echo"<script>alert('Proses Tanggal Berhasil');window.location='01_tambah_logbook.php?tanggal=$_POST[tanggal]'</script>"; 
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='01_tambah_logbook.php'</script>"; 
					}
				}
	
				if(isset($_POST['submit']))
				{
					$tgl = $_POST['tanggal'];
					$tanggal = substr($tgl,8,2);
					$bulan = substr($tgl,5,2);
					$tahun = substr($tgl,0,4);
					$query = mysql_query("SELECT status_pengaturan_logbook FROM tb_pengaturan_logbook WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_logbook) = '$bulan' AND year(tanggal_pengaturan_logbook) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_logbook'] == 'N')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah Logbook karena status sedang tidak aktif. Silahkan hubungi admin');window.location='01_tambah_logbook.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_logbook'] == 'Y' OR empty($dapat))
					{
						$query=mysql_query("insert into tb_logbook(tanggal_logbook, jumlah_menit, keterangan, jumlah_kegiatan_skp, output_kegiatan_skp, jumlah_kegiatan, output_kegiatan, status, nip, id_daftar_skp, id_detail_skp)
									values('$_POST[tanggal_logbook]','$_POST[waktu]','$_POST[keterangan]','$_POST[jumlah_kegiatan_skp]','$_POST[output_kegiatan_skp]','$_POST[jumlah_kegiatan]','$_POST[output_kegiatan]','Belum di Nilai', '$_SESSION[nip]', '$_POST[skp]', '$_POST[detail]')");
						if($query){
							echo"<script>alert('Data Berhasil di Simpan');window.location='01_tambah_logbook.php'</script>";
						}
						else
						{
							echo"<script>alert('Data Gagal di Simpan');window.location='01_tambah_logbook.php'</script>";
						}
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='01_tambah_logbook.php'</script>"; 
					}
				}				
		?>


 	
	</body>
</html>