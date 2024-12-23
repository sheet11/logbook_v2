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
				<td align="left" colspan="6" class="info"><b>Isi bulan pengisian Logbook</b></td>
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
							<li>Mohon download terlebih dahulu data daftar SKP dan data detail SKP sesuai dengan bulan yang anda inputkan.</li>
							<li>File import harus berupa file excel (.xls dan .xlsx)</li>
							<li>Data file excel harus mengikuti format yang sudah ditentukan (download file format pada tombol dibawah)</li>
							<li>Data maksimal 300 item untuk sekali import</li>
							<li>Penulisan tanggal seperti berikut: tanggal/bulan/tahun atau 01/12/2017</li>
						</ol>
						Download format pada tombol dibawah ini:<br />
						<?php
							$tgl = $_GET['tanggal'];
							$tanggal = substr($tgl,8,2);
							$bulan = substr($tgl,5,2);
							$tahun = substr($tgl,0,4);
						?>
						<a href="10_export_skp.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>"><input type="button" value="Download File Data Daftar SKP" class="btn btn-danger"></a> &nbsp;
						<a href="10_export_detail_skp.php?bulan=<?php echo $bulan; ?>&tahun=<?php echo $tahun; ?>"><input type="button" value="Download File Data Detail SKP" class="btn btn-danger"></a> &nbsp;
						<a href="../assets/files/dataLogbook.xlsx"><input type="button" value="Download File Excel Logbook" class="btn btn-warning"></a> <br /><br />
	<form method="post" action="" enctype="multipart/form-data">	
		<table width="100%" class="table table-bordered">
			<tr>
				<td align="left" colspan="6" class="info"><b>Import Data Logbook</b></td>
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
					$query = mysql_query("SELECT status_pengaturan_logbook FROM tb_pengaturan_logbook WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_logbook) = '$bulan' AND year(tanggal_pengaturan_logbook) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_logbook'] == 'N')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah Logbook karena status sedang tidak aktif. Silahkan hubungi admin');window.location='10_import_logbook.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_logbook'] == 'Y' OR empty($dapat))
					{
						echo"<script>alert('Proses Tanggal Berhasil');window.location='10_import_logbook.php?tanggal=$_POST[bulan]'</script>"; 
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='10_import_logbook.php'</script>"; 
					}
				}
	
				if(isset($_POST['importSKP']))
				{
					$tgl = $_POST['bulan'];
					$tanggal = substr($tgl,8,2);
					$bulan = substr($tgl,5,2);
					$tahun = substr($tgl,0,4);
					$query = mysql_query("SELECT status_pengaturan_logbook FROM tb_pengaturan_logbook WHERE nip_pegawai='$_SESSION[nip]' AND month(tanggal_pengaturan_logbook) = '$bulan' AND year(tanggal_pengaturan_logbook) = '$tahun'");
					$dapat = mysql_fetch_array($query);
					if($dapat['status_pengaturan_logbook'] == 'N')
					{
						echo"<script>alert('Mohon maaf Anda tidak bisa menambah Logbook karena status sedang tidak aktif. Silahkan hubungi admin');window.location='10_import_logbook.php'</script>"; 
					}
					elseif($dapat['status_pengaturan_logbook'] == 'Y' OR empty($dapat))
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
								$tgl = trim($allDataInSheet[$i]["A"]);
								$bulan = substr($tgl,0,2);
								$tanggal = substr($tgl,3,2);
								$tahun = substr($tgl,6,4);
								$realTanggal = $tahun.'-'.$bulan.'-'.$tanggal;
								
								$waktuLogbook = trim($allDataInSheet[$i]["B"]);
								$arr1 = explode(":", $waktuLogbook);
								$menit1 = $arr1[0]*60;
								$jam1 = $arr1[1];
								$tjam1 = $menit1 + $jam1;
								
								$keterangan = trim($allDataInSheet[$i]["C"]);
								$idSkp = trim($allDataInSheet[$i]["D"]);
								$jumlahKegiatanSkp = trim($allDataInSheet[$i]["E"]);
								$outputKegiatanSkp = trim($allDataInSheet[$i]["F"]);
								$idDetailSkp = trim($allDataInSheet[$i]["G"]);
								$jumlahKegiatanDetailSkp = trim($allDataInSheet[$i]["H"]);
								$outputKegiatanDetailSkp = trim($allDataInSheet[$i]["I"]);
								$nip = $_SESSION['nip'];
								$status = 'Belum di Nilai';
								$insertTable= mysql_query("insert into tb_logbook (tanggal_logbook, jumlah_menit, total_menit, keterangan, id_daftar_skp, jumlah_kegiatan_skp, output_kegiatan_skp, id_detail_skp, jumlah_kegiatan, output_kegiatan, nip, status)
								VALUES ('".$realTanggal."', '".$waktuLogbook."', '".$tjam1."', '".$keterangan."', '".$idSkp."', '".$jumlahKegiatanSkp."', '".$outputKegiatanSkp."', '".$idDetailSkp."', '".$jumlahKegiatanDetailSkp."', '".$outputKegiatanDetailSkp."', '".$nip."', '".$status."');");
								if($insertTable)
								{
									echo"<script>alert('Proses Import Data Berhasil');window.location='10_import_logbook.php'</script>";
									unlink("../assets/tmp/".$fileName);
								}
							}
						}
						else
						{
							echo"<script>alert('Ada kesalahan dalam upload file');window.location='10_import_logbook.php'</script>";
						}
					}
					else
					{
						echo"<script>alert('Error!!!');window.location='10_import_logbook.php'</script>"; 
					}
				}					
		?>


 	
	</body>
</html>
