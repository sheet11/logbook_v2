<?php 
	include"01_nav.php";
    include "../assets/js/date.php";
    error_reporting(0); 
?>


<?php
	require_once("../config/koneksi.php");
	$query=mysql_query("select * from tb_pegawai where id_pegawai='$_GET[id_pegawai]'");
	$a=mysql_fetch_array($query);
?>


<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
		<form method="post" action="07_prosesedit_pegawai.php" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<input type="hidden" name="id_pegawai" value="<?php echo "$a[id_pegawai]"; ?>">
			<tr>
				<td colspan="4" class="success"><b>Edit Data Pegawai</b></td>
			</tr>

			<tr>
        		<td>NIP</td>
				<td><input type="text" name="nip" class="form-control" value="<?php echo "$a[nip]"; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Nama Lengkap</td>
				<td><input type="text" name="nama_lengkap" class="form-control" value="<?php echo "$a[nama_lengkap]"; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Alamat</td>
				<td><input type="text" name="alamat" class="form-control" value="<?php echo "$a[alamat]"; ?>" ></td>
        	</tr>

        	<tr>
        		<td>No HP</td>
				<td><input type="text" name="no_hp" class="form-control" value="<?php echo "$a[no_hp]"; ?>" ></td>
        	</tr>

			<tr>
        		<td>Pangkat</td>
				<td><input type="text" name="pangkat" class="form-control" value="<?php echo "$a[pangkat]"; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Jabatan</td>
				<td><input type="text" name="jabatan" class="form-control" value="<?php echo "$a[jabatan]"; ?>" ></td>
        	</tr>

        	<tr>
        		<td>Unit Kerja</td>
				<td><input type="text" name="unit_kerja" class="form-control" value="<?php echo "$a[unit_kerja]"; ?>" ></td>
        	</tr>

        	<tr>
			    <td>Level</td>
			    <td>
			        	<select name='level' class='form-control' >";
			        	<option value="<?php echo $a['level']; ?>"><?php echo $a['level']; ?></option>
			            <?php include "../config/koneksi.php";
			        	$query = mysql_query("SELECT * FROM tb_level ");
			        	while ($row = mysql_fetch_array($query)) {
			       		 echo"
			        	<option value='$row[nama_level]'>$row[nama_level]</option>
			        	";
			       		 }
			        	?>
			        	echo"</select>
			    </td>
			</tr>

        	<tr>

        		<td>NIP Atasan</td>
				<td><input type="text" name="nip_atasan" class="form-control" value="<?php echo "$a[nip_atasan]"; ?>"></td>
        	</tr>
			
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="submit" value="Simpan" class="btn btn-danger">
					<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>
		</table>

	</form>

	</div>

</div>
