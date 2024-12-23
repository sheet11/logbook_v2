<?php 	include"01_nav.php";
		include"../assets/js/date.php";
		error_reporting(0); ?>

<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">


	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="4" class="success"><b><h4>Tambah Data Pegawai</b></h4></td>
			</tr>

			<tr>
        		<td width="25%">Password</td>
        		<td width="2%">:</td>
				<td><input type="text" name="password" class="form-control" required="yes" ></td>
        	</tr>

			<tr>
        		<td>NIP</td>
        		<td width="2%">:</td>
				<td><input type="text" name="nip" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Nama Lengkap</td>
        		<td width="2%">:</td>
				<td><input type="text" name="nama_lengkap" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Alamat</td>
        		<td width="2%">:</td>
				<td><input type="text" name="alamat" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>No HP</td>
        		<td width="2%">:</td>
				<td><input type="text" name="no_hp" class="form-control" required="yes" ></td>
        	</tr>

			<tr>
        		<td>Pangkat</td>
        		<td width="2%">:</td>
				<td><input type="text" name="pangkat" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Jabatan</td>
        		<td width="2%">:</td>
				<td><input type="text" name="jabatan" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Unit Kerja</td>
        		<td width="2%">:</td>
				<td><input type="text" name="unit_kerja" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Grade</td>
        		<td width="2%">:</td>
				<td><input type="text" name="grade" class="form-control" ></td>
        	</tr>

        	<tr>
        		<td>Index Value</td>
        		<td width="2%">:</td>
				<td><input type="text" name="index_value" class="form-control" ></td>
        	</tr>

        	<tr>
        		<td>Level</td>
        		<td width="2%">:</td>
				<td><select name="level" type="select" class="form-control" required="yes" >
	    			<option value="">-- Silahkan Dipilih --</option>
					<option value="pegawai">Pegawai</option>
					<option value="atasan">Atasan</option>
					<option value="penilai">Penilai</option>
					<option value="administrator">Administrator</option>
	          		</select>
	          	</td>
        	</tr>

        	<tr>
        		<td>Nama Bank</td>
        		<td width="2%">:</td>
				<td><input type="text" name="nama_bank" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>Atas Nama</td>
        		<td width="2%">:</td>
				<td><input type="text" name="atas_nama" class="form-control" required="yes" ></td>
        	</tr>

        	<tr>
        		<td>No Rekening</td>
        		<td width="2%">:</td>
				<td><input type="text" name="no_rekening" class="form-control" required="yes" ></td>
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
			include"../config/koneksi.php";
	
				if(isset($_POST['submit'])){
														
				$query=mysql_query("insert into tb_pegawai(password, nip, nama_lengkap, alamat, no_hp, pangkat, jabatan, unit_kerja, grade, index_value, level, nama_bank, atas_nama, no_rekening)
									values('$_POST[password]','$_POST[nip]','$_POST[nama_lengkap]','$_POST[alamat]','$_POST[no_hp]','$_POST[pangkat]','$_POST[jabatan]','$_POST[unit_kerja]','$_POST[grade]','$_POST[index_value]','$_POST[level]','$_POST[nama_bank]','$_POST[atas_nama]','$_POST[no_rekening]')");
					
										
					if($query){
						echo"<script>alert('Data Berhasil di Simpan');window.location='07_daftar_pegawai.php'</script>";
					}
				}					
		?>


 	
	</body>
</html>
