<?php
	include "session.php";
	include("bar128.php");
    include("library.php");
	include("fucnt_tgl.php");
	require_once("../config/koneksi.php");
	
	$query = mysql_query("SELECT * FROM `tb_logbook` WHERE month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND nip='$_SESSION[nip]'");
	$jumlah = mysql_num_rows($query);
	
	$qr = mysql_query("SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `jumlah_menit` ) ) ) AS timeSum FROM tb_logbook WHERE month(tanggal_logbook) = '$_GET[bulan]' AND year(tanggal_logbook) = '$_GET[tahun]' AND nip='$_SESSION[nip]'");
	$qry = mysql_fetch_assoc($qr);
	$arr = explode(":", $qry['timeSum']);
	$jumenit = substr($qry['timeSum'], 0, 5);
	$jam = $arr[1]/60;
	$hjam1 = $arr[0] * 25000;
	$hjam2 = $jam * 25000;
	$tuang = floor($hjam1 + $hjam2);
	$juang = number_format($tuang, 0, '', '.');
	$kueri = mysql_fetch_array(mysql_query("SELECT * FROM tb_absensi where month(bulan) = '$_GET[bulan]' AND year(bulan)='$_GET[tahun]' AND nip='$_SESSION[nip]'"));
	$izin = $kueri['izin'];
	$sakit = $kueri['sakit'];
	$alpa = $kueri['alpa'];
	$totalabsen = $tuang-$izin-$sakit-$alpa;
	$totuang = number_format($totalabsen, 0, '', '.');

if($query)
				{
					/** Error reporting */
					error_reporting(E_ALL);
					ini_set('display_errors', TRUE);
					ini_set('display_startup_errors', TRUE);
					date_default_timezone_set('Europe/London');
					
					if (PHP_SAPI == 'cli')
						die('This example should only be run from a Web Browser');
					
					/** Include PHPExcel */
					require_once dirname(__FILE__) . '/../assets/Classes/PHPExcel.php';
					
					// Create new PHPExcel object
					$objPHPExcel = new PHPExcel();
					
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'NIP')
						->setCellValue('C1', $_SESSION['nip'])
						->setCellValue('A2', 'Nama Pegawai')
						->setCellValue('C2', $_SESSION['nama_lengkap'])
						->setCellValue('A3', 'Unit Kerja')
						->setCellValue('C3', $_SESSION['unit_kerja'])
						->setCellValue('A4', 'Jabatan')
						->setCellValue('C4', $_SESSION['jabatan'])
						->setCellValue('A5', 'Grade')
						->setCellValue('C5', $_SESSION['grade']);
						
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A7', 'Total Kuantitatif')
						->setCellValue('D7', $jumlah)
						->setCellValue('A8', 'Total Jam Kerja Efektif')
						->setCellValue('D8', $jumenit)
						->setCellValue('A9', 'Total uang')
						->setCellValue('D9', $juang)
						->setCellValue('A10', 'Total uang setelah dikurangi absensi')
						->setCellValue('D10', $totuang);
						
					// Add some data
					$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A12', 'No')
						->setCellValue('B12', 'TANGGAL')
						->setCellValue('C12', 'URAIAN KEGIATAN')
						->setCellValue('D12', 'JUMLAH MENIT')
						->setCellValue('E12', 'KETERANGAN')
						->setCellValue('F12', 'JUMLAH KEGIATAN')
						->setCellValue('G12', 'OUTPUT KEGIATAN')
						->setCellValue('H12', 'AKSI');
					
					$objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
					$objPHPExcel->getActiveSheet()->mergeCells('A7:C7');
					
					$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
					$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
					$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
					$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
					$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
					
					$styleArray = array(
					'borders' => array(
					'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
					)
					)
					);
					$objPHPExcel->getDefaultStyle()->applyFromArray($styleArray);
					
					
					// Data From Database
					while($d=mysql_fetch_array($query))
					{
						$jumenit = substr($d['jumlah_menit'], 0, 5);
						$n=13;
						$i = 1;
						$objPHPExcel->getActiveSheet()->setCellValue('A'.$n, $i);
						$objPHPExcel->getActiveSheet()->setCellValue('B'.$n, $d['tanggal_logbook']);
						$objPHPExcel->getActiveSheet()->setCellValue('C'.$n, $d['uraian_pekerjaan']);
						$objPHPExcel->getActiveSheet()->setCellValue('D'.$n, $jumenit);
						$objPHPExcel->getActiveSheet()->setCellValue('E'.$n, $d['keterangan']);
						$objPHPExcel->getActiveSheet()->setCellValue('F'.$n, $d['jumlah_kegiatan']);
						$objPHPExcel->getActiveSheet()->setCellValue('G'.$n, $d['output_kegiatan']);
						$objPHPExcel->getActiveSheet()->setCellValue('H'.$n, $d['status_penilai']);
						$n++; $i++;
					}
					
					// Rename worksheet
					$objPHPExcel->getActiveSheet()->setTitle('Logbook Bulanan');
					
					// Set active sheet index to the first sheet, so Excel opens this as the first sheet
					$objPHPExcel->setActiveSheetIndex(0);
					
					// Redirect output to a client’s web browser (Excel2007)
					header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
					header('Content-Disposition: attachment;filename="Logbookbulanan.xlsx"');
					header('Cache-Control: max-age=0');
					ob_end_clean();
					
					// If you're serving to IE 9, then the following may be needed
					header('Cache-Control: max-age=1');
					
					// If you're serving to IE over SSL, then the following may be needed
					header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
					header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
					header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
					header ('Pragma: public'); // HTTP/1.0
					
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
					$objWriter->save('php://output');
					exit;
				}
				
				else{		
					echo"data tidak ditemukan";
				}	
?>