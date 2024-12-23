<?php
include"01_nav.php";
include"../assets/js/date2.php";
error_reporting(1);
?>
<style>

.ui-datepicker-calendar {

    display: none;

    }

</style>
<div id="page-wrapper">
    <div class="container-fluid" style="margin:30px;">
	<?php 
	if (empty($_GET['tanggal']))
	{
	?>
	<form method="post" action="">
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="6" class="info"><b>Isi bulan pengisian SKP</b></td>
			</tr>

			<tr>
        		<td width="25%"><b>Bulan</b></td>
        		<td width="2%">:</td>
				<td colspan="4"><input type="text" id="tglbln" name="bulan" required="yes" class="form-control"></td>
        	</tr>

			<tr>
				<td colspan="2">&nbsp;</td>
				<td colspan="4"><input type="submit" name="proses" value="Proses" class="btn btn-success"></td>
			</tr>
		</table> 
	</form>
	<?php
	}
	else
	{
	?>

<b>Perhatian:</b>
						<ol>
							<li>File import harus berupa file excel (.xls dan .xlsx)</li>
							<li>Data file excel harus mengikuti format yang sudah ditentukan (download file format pada tombol dibawah)</li>
							<li>Data maksimal 300 item untuk sekali import</li>	
						</ol>
						Download format pada tombol dibawah ini:<br />
						<a href="../assets/files/dataskp.xlsx"><input type="button" value="Download File Excel SKP" class="btn btn-warning"></a> <br /><br />
	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="6" class="info"><b>Import Data SKP</b></td>
			</tr>

			<tr>
        		<td width="25%"><b>Pilih file Excel</b></td>
        		<td width="2%">:</td>
				<td colspan="4"><input type="hidden" name="bulan" value="<?php echo $_GET['tanggal']; ?>"><input type="file" accept=".xls, .xlsx" name="file" placeholder="Pilih file Excel" class="form-control"  required></td>
        	</tr>

			<tr>
				<td colspan="2">&nbsp;</td>
				<td colspan="4"><input type="submit" name="importSKP" value="Simpan" class="btn btn-danger">
								<input type="reset" name="submit" value="Hapus" class="btn btn-success"></td>
			</tr>

		</table>      
	</form>
	<?php
	}
	?>

	</div>
</div>

		<?php
			include"../config/koneksi.php";
				if(isset($_POST['proses']))
				{
					$tgl = $_POST['bulan'];
					$tanggal = substr($tgl,8,2);
					$bulan = substr($tgl,5,2);
					$tahun = substr($tgl,0,4);
					$query = mysql_query("SELECT status_pengaturan_skp FROM tb_pengaturan_skp WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_skp) = '$bulan' AND year(tanggal_pengaturan_skp) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah SKP karena status sedang tidak aktif. Silahkan hubungi admin');window.location='10_import_skp.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_skp'] == 'N' OR empty($dapat))
					{
						echo"<script>alert('Proses Tanggal Berhasil');window.location='10_import_skp.php?tanggal=$_POST[bulan]'</script>"; 
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='10_import_skp.php'</script>"; 
					}
				}
	
				if(isset($_POST['importSKP']))
				{
					$tgl = $_POST['bulan'];
					$tanggal = substr($tgl,8,2);
					$bulan = substr($tgl,5,2);
					$tahun = substr($tgl,0,4);
					$query = mysql_query("SELECT status_pengaturan_skp FROM tb_pengaturan_skp WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_skp) = '$bulan' AND year(tanggal_pengaturan_skp) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_skp'] == 'Y')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah SKP karena status sedang tidak aktif. Silahkan hubungi admin');window.location='10_import_skp.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_skp'] == 'N' OR empty($dapat))
					{
						$temp = $_FILES['file']['tmp_name'];
						$fileName = time().$_FILES['file']['name'];
						$size = $_FILES['file']['size'];
						$type = $_FILES['file']['type'];
						$path = "../assets/tmp/";
						$upload = move_uploaded_file($temp, $path.$fileName);
						if($upload)
						{
							include "../assets/Classes/PHPExcel/IOFactory.php";
						
							$inputFileName =  "../assets/tmp/".$fileName;
							try
							{
								$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
							}
							catch(Exception $e)
							{
								die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
							}
						
							$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
							$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
						
							for($i=2;$i<=$arrayCount;$i++)
							{
								//$tgl = trim($allDataInSheet[$i]["A"]); // 30/01/2017 2017-01-30
								//$bulan = substr($tgl,0,2);
								//$tanggal = substr($tgl,3,2);
								//$tahun = substr($tgl,6,4);
								$realTanggal = $tahun.'-'.$bulan.'-'.$tanggal;
								$namaSkp = trim($allDataInSheet[$i]["A"]);
								$target = trim($allDataInSheet[$i]["B"]);
								$outputKegiatan = trim($allDataInSheet[$i]["C"]);
								$mutu = trim($allDataInSheet[$i]["D"]);
								$nip = $_SESSION['nip'];
								$insertTable= mysql_query("insert into tb_daftar_skp (bulan, nama_skp, target_kegiatan, output_kegiatan, mutu, nip, status) VALUES ('".$tgl."', '".$namaSkp."', '".$target."', '".$outputKegiatan."', '".$mutu."', '".$nip."', 'Belum Di Nilai');");
								if($insertTable)
								{
									echo"<script>alert('Proses Import Data Berhasil');window.location='10_import_skp.php'</script>";
									unlink("../assets/tmp/".$fileName);
								}
							}
						}
						else
						{
							echo"<script>alert('Ada kesalahan dalam upload file');window.location='10_import_skp.php'</script>";
						}
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='10_import_skp.php'</script>"; 
					}
				}					
		?>


 	
	</body>
</html>
