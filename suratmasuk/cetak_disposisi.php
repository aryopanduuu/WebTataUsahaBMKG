<?php
// memanggil library FPDF
require('../fpdf182/fpdf.php');
include 'function.php';

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('p', 'mm', 'A4');

// membuat halaman baru

// ;
$pdf->SetMargins(5, 4, 5);
$pdf->AddPage();
$pdf->Rect(5, 4, 200, 139, 'D');
$pdf->Rect(4, 3, 202, 141, 'D');
// header

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(200, 1, '', 0, 1);
$pdf->Cell(55, 4, '', 0, 0);
$pdf->Cell(125, 4, 'BADAN METEOROLOGI, KLIMATOLOGI, DAN GEOFISIKA', 0, 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(19, 4, 'FM.TU.06.00.02', 1, 1, "C");

$pdf->Image('../img/logo-bmkg.png', 30, 7, 13);
$pdf->Image('../img/logo-nqa.png', 164, 7, 20);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 4, 'STASIUN METEOROLOGI KELAS I JUANDA SIDOARJO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(200, 3, 'Bandar Udara Internasional Juanda Surabaya', 0, 1, 'C');
$pdf->Cell(200, 3, 'Telepon: (031) 8667540, Fax: (031) 8675342', 0, 1, 'C');
$pdf->Cell(200, 3, 'Email: stamet.juanda@bmkg.go.id dan kstujud@gmail.com', 0, 1, 'C');
$pdf->Cell(200, 3, 'Website: juanda.jatim.bmkg.go.id', 0, 1, 'C');
//-------------------------------------------------------------------------

// judul
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(200, 1, '', 0, 1);
$pdf->Cell(200, 6, 'LEMBAR DISPOSISI', 1, 1, 'C');

$id = $_GET['id'];
$row = query("SELECT * FROM surat_masuk WHERE id = $id")[0];

// data teknis
$pdf->SetTitle($row['no_agenda']);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(35, 5, 'Nomor Agenda', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, $row['no_agenda'], 'T,B', 1);
$pdf->Cell(35, 5, 'Tingkat Keamanan', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, $row['tk_keamanan'], 'T,B', 1);
$pdf->Cell(35, 5, 'Tanggal Penerimaan', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, tanggal_indo($row['tgl_agenda']), 'T,B', 1);
$pdf->Cell(35, 5, 'Nomor Surat', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, htmlspecialchars_decode($row['no_surat']), 'T,B', 1);
$pdf->Cell(35, 5, 'Tanggal Surat', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, tanggal_indo($row['tgl_surat']), 'T,B', 1);
$pdf->Cell(35, 5, 'Asal Surat', 'T,B', 0);
$pdf->Cell(1, 5, ':', 'T,B', 0, 'C');
$pdf->Cell(164, 5, htmlspecialchars_decode($row['asal_surat']), 'T,B', 1);
$pdf->Cell(35, 5, 'Perihal', 'T', 0);
$pdf->Cell(1, 5, ':', 'T', 0, 'C');
$pdf->MultiCell(164, 5, htmlspecialchars_decode($row['perihal']), 'T', 1);

$tek = explode(',', $row['diteruskan']);
// $user0 = $tek[0];
// if(empty($tek[1])){
//     $user1 = '';
// }else{
//     $user1=$tek[1];
// }
// // $user2 = $tek[2];
// if(empty($tek[2])){
//     $user2 = '';
// }else{
//     $user2=$tek[2];
// }
// if(empty($tek[3])){
//     $user3 = '';
// }else{
//     $user3=$tek[3];
// }
// // $user3 = 'plpk';
// $user4 = 'usler';
// $daftartek = $row["diteruskan"];

// $tek[1];
// $notek = 1;
// echo "<pre>";
// print_r($tek);
// echo "</pre>";
// foreach ($array as $teknisi) {
//     if ($teknisi != "") {
//         $tahutek = $notek . "." . $teknisi;
//     }
//     $notek++;

// }
//----------------------------------------
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(200, 5, 'Diteruskan kepada Yth:', 1, 1, 'C');

if (in_array('kstu',$tek)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->Cell(5, 6, '', 'T,B', 0, 'L');
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(45, 6, 'Kasubag Tata Usaha', 'T,B', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
} else {
    $pdf->SetTextColor(87, 87, 87);
    // $pdf->SetTextColor(200, 200, 200);
    $pdf->Cell(5, 6, '', 'T,B', 0, 'L');
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(45, 6, 'Kasubag Tata Usaha', 'T,B', 0, 'L');
}

if (in_array('kdat',$tek)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 6, 'KoorBid Datin', 'T,B', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
} else {
    $pdf->SetTextColor(87, 87, 87);
    // $pdf->SetTextColor(200, 200, 200);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 6, 'KoorBid Datin', 'T,B', 0, 'L');
}

if (in_array('kobs',$tek)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, 'KoorBid Observasi', 'T,B', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
} else {
    $pdf->SetTextColor(87, 87, 87);
    // $pdf->SetTextColor(200, 200, 200);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, 'KoorBid Observasi', 'T,B', 0, 'L');
}

if (in_array('ppk',$tek)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 6, 'PPK', 'T,B', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
} else {
    $pdf->SetTextColor(87, 87, 87);
    // $pdf->SetTextColor(200, 200, 200);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(20, 6, 'PPK', 'T,B', 0, 'L');
}

if (in_array('user',$tek)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 6, 'lainnya', 'T,B', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
} else {
    $pdf->SetTextColor(87, 87, 87);
    // $pdf->SetTextColor(200, 200, 200);
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(35, 6, 'lainnya', 'T,B', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(200, 6, 'Disposisi:', 1, 1, 'C');

$pilihan = explode(',', $row['pilihan']);
// if(empty($pilihan[0])){
//     $pilihan1 = '';
// }else{
//     $pilihan1=$pilihan[0];
// }
// // $user2 = $pilihan[2];
// if(empty($pilihan[1])){
//     $pilihan2 = '';
// }else{
//     $pilihan2=$pilihan[1];
// }


if (in_array('tindaklanjut',$pilihan)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->Cell(65, 6, '', 'T,B', 0, 'L');
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 6, 'Tindak Lanjut', 'T,B', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->Cell(65, 6, '', 'T,B', 0, 'L');
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(50, 6, 'Tindak Lanjut', 'T,B', 0, 'L');  
}
if (in_array('diketahui',$pilihan)) {
$pdf->SetTextColor(0, 0, 204);
$pdf->SetFont('ZapfDingbats', '', 11);
$pdf->Cell(3.5, 6, chr(52), 'T,B', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(75, 6, 'Diketahui', 'T,B', 1, 'L');
$pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 6, chr(111), 'T,B', 0);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(75, 6, 'Diketahui', 'T,B', 1, 'L'); 
}
$opsi = explode(',', $row['opsi']);
// if(empty($opsi[0])){
//     $anon = '';
// }else{
//     $anon=$opsi[0];
// }
// if(empty($opsi[1])){
//     $anon1 = '';
// }else{
//     $anon1=$opsi[1];
// }
// if(empty($opsi[2])){
//     $anon2 = '';
// }else{
//     $anon2=$opsi[2];
// }
// if(empty($opsi[3])){
//     $anon3 = '';
// }else{
//     $anon3=$opsi[3];
// }
// if(empty($opsi[4])){
//     $anon4 = '';
// }else{
//     $anon4=$opsi[4];
// }
// echo "<pre>";
// print_r($opsi);
// echo "</pre>";
//Baris 1....................
if (in_array('mewakili',$opsi)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Harap Mewakili', 'T', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Harap Mewakili', 'T', 0, 'L');
}
if (in_array('konsultasi',$opsi)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Dikonsultasikan dengan', 'T', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Dikonsultasikan dengan', 'T', 0, 'L');
}
if (in_array('diteruskan',$opsi)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diteruskan', 'T', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diteruskan', 'T', 0, 'L'); 
}
if (in_array('dimonitor',$opsi)) {
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dimonitor', 'T', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), 'T', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dimonitor', 'T', 1, 'L');
}
//Baris 2.....
if(in_array('mendampingi',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Hadir mendampingi', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Hadir mendampingi', '0', 0, 'L');
}
if(in_array('jawaban',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Dibuat surat jawaban', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Dibuat surat jawaban', '0', 0, 'L');
}
if(in_array('diselesaikan',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diselesaikan', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diselesaikan', '0', 0, 'L');
}
if(in_array('masukan',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dijadikan bahan masukan', '0', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dijadikan bahan masukan', '0', 1, 'L');
}
//Baris 3................

if(in_array('tindaklanjut',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Segera ditindaklanjuti', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Segera ditindaklanjuti', '0', 0, 'L');
}
if(in_array('monitoring',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Bahan monitoring', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Bahan monitoring', '0', 0, 'L');
}
if(in_array('dipelajari',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk dipelajari', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk dipelajari', '0', 0, 'L');
}
if(in_array('diskusi',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk didiskusikan dengan...', '0', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk didiskusikan dengan...', '0', 1, 'L');
}
//Baris 4............
if(in_array('masukan',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Mohon tanggapan/saran/masukan', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Mohon tanggapan/saran/masukan', '0', 0, 'L');
}
if(in_array('edaran',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Buat Surat Edaran', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Buat Surat Edaran', '0', 0, 'L');
}
if(in_array('diketahui',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diketahui', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk diketahui', '0', 0, 'L');
}
if(in_array('koordinasi',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dikoordinasikan dengan...', '0', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk dikoordinasikan dengan...', '0', 1, 'L');
}
//Baris 5..............
if(in_array('fasilitas',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Fasilitasi sesuai ketetapan berlaku', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(55, 5, 'Fasilitasi sesuai ketetapan berlaku', '0', 0, 'L');
}
if(in_array('tugas',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Untuk dibuat Surat Tugas', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(45, 5, 'Untuk dibuat Surat Tugas', '0', 0, 'L');
}
if(in_array('direkap',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk direkap ', '0', 0, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(32, 5, 'Untuk direkap ', '0', 0, 'L');
}
if(in_array('diarsipkan',$opsi)){
    $pdf->SetTextColor(0, 0, 204);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(52), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk diarsipkan', '0', 1, 'L');
    $pdf->SetTextColor(0, 0, 0);
}else{
    $pdf->SetTextColor(87, 87, 87);
    $pdf->SetFont('ZapfDingbats', '', 11);
    $pdf->Cell(3.5, 5, chr(111), '0', 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(54, 5, 'Untuk diarsipkan', '0', 1, 'L');
}
// $catatan = explode(',', $row['catatan']);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(200, 5, 'Catatan Khusus:', 'T', 1, 'L');
    $pdf->Cell(200, 5, $row['catatan'], 'T', 1,'L');

$pdf->Output();
