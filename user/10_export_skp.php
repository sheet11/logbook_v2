<?php
include "../config/koneksi.php";
include "session.php";
$skp = mysql_query("SELECT * FROM `tb_daftar_skp` WHERE nip='$_SESSION[nip]' AND month(bulan) = '$_GET[bulan]' AND year(bulan) = '$_GET[tahun]'");
require_once '../assets/Classes/PHPExcel.php';
require_once '../assets/Classes/PHPExcel/IOFactory.php';

$objPHPExcel = new PHPExcel();

$row = 1;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, 'id Daftar SKP')
            ->setCellValue('B'.$row, 'Tanggal')
            ->setCellValue('C'.$row, 'Nama SKP')
            ->setCellValue('D'.$row, 'Target Kegiatan')
            ->setCellValue('E'.$row, 'Output Kegiatan')
            ->setCellValue('F'.$row, 'Mutu');
$row++;

while( $data = mysql_fetch_array($skp)){
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$row, $data['id_daftar_skp'])
            ->setCellValue('B'.$row, $data['bulan'] )
            ->setCellValue('C'.$row, $data['nama_skp'] )
            ->setCellValue('D'.$row, $data['target_kegiatan'] )
            ->setCellValue('E'.$row, $data['output_kegiatan'] )
            ->setCellValue('F'.$row, $data['mutu'] );
			
	$row++;
}

$objPHPExcel->getActiveSheet()->setTitle('Daftar SKP');
$objPHPExcel->setActiveSheetIndex(0);

// Download (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data.xlsx"');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 

$objWriter->save('php://output');
exit;

?>