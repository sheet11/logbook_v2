
    <h3>Daftar Data Pegawai</h3>

       <table border="1">   		
		 <tr>
			<th width="5%">No.</th><th>Nama Pegawai</th><th>Alamat</th><th>No HP</th><th>Pangkat</th><th>Jabatan</th><th>Unit Kerja</th><th>Grade</th><th>Index Value</th><th>Nama Bank</th><th>Atas Nama</th><th>No Rekening</th>
			<?php 
			include "../config/koneksi.php";
							
					$query=mysql_query("select * from tb_pegawai ");
				
					$i =  +1;		
				while($a=mysql_fetch_array($query)){
				echo"
				<tr>
					<td>$i</td>
					<td>$a[nama_lengkap]</td>
					<td>$a[alamat]</td>
					<td>$a[no_hp]</td>
					<td>$a[pangkat]</td>
					<td>$a[jabatan]</td>
					<td>$a[unit_kerja]</td>
					<td>$a[grade]</td>
					<td>$a[index_value]</td>
					<td>$a[nama_bank]</td>
					<td>$a[atas_nama]</td>
					<td>$a[no_rekening]</td>
				</tr>";

				$i++;
			}
			?>
			</table>




