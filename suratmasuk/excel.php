<!DOCTYPE html>
<html>
<?php
setlocale (LC_TIME, 'IND');
?>
<?php

// $filter = "WHERE YEAR(tgl_agenda)='". $_POST['pilihTahun']."' ";
$keyword = $_POST['keyword'];
// $filter ="WHERE year(tgl_agenda)=$keyword ";
// $filter ="WHERE YEAR(tgl_agenda)='". $_POST['pilihTahun']."' AND no_agenda LIKE'%$keyword' OR
// tk_keamanan LIKE '%$keyword' OR
// tgl_agenda LIKE '%$keyword' OR
// tgl_surat LIKE '%$keyword%' OR
// no_surat like '%$keyword%' OR
// asal_surat LIKE '%$keyword' OR
// perihal like '%$keyword'
// "
$filter = "WHERE no_agenda LIKE'%$keyword' OR
tk_keamanan LIKE '%$keyword' OR
tgl_agenda LIKE '%$keyword' OR
tgl_surat LIKE '%$keyword%' OR
no_surat like '%$keyword%' OR
asal_surat LIKE '%$keyword' OR
perihal like '%$keyword'OR
lampiran LIKE '%$keyword' OR
status_surat like '%$keyword' OR
diteruskan like '%$keyword'"
?>
<head>
	<title>Export Excel</title>
</head>

<body>
	<style type="text/css">
		body {
			font-family: sans-serif;
			text-align: center;
		}
	</style>

	<?php
	//Siapkan Nama File yang akan di export
	$nama_file = "surat-masuk";
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attechment; filename=" . $nama_file . ".xls");
	header('Pragma: no-cache');
	?>

	<h3>Rekap Surat Masuk <br> 
	<h3><p class="text-center"><b>TAHUN <?= strtoupper(strftime( "%B", time()));?>  <?=date('Y')?> </b></p></h3></h3>

	<table border="1" align="center" width="500">
		<tr>
			<th>No</th>
			<th>Tk Keamanan</th>
			<th>Tgl Agenda</th>
			<th>No Agenda</th>
			<th>No Surat</th>
			<th>Tgl Surat</th>
			<th>Asal Surat</th>
			<th>Perihal</th>
			<th>Lampiran</th>
			<th>Status</th>
			<th>Status disposisi</th>
		</tr>
		<?php
		//panggil koneksi database
		include "function.php";
		//manampilkan data pegawai
		session_start();
		// $filter = $_SESSION['filter'];
		$test = mysqli_query($conn, "(SELECT * FROM `surat_masuk` $filter) ORDER by id ASC");
		$data1 = "";
		$no = 1;
		while ($data = mysqli_fetch_array($test)) {
		?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $data['tk_keamanan'] ?></td>
				<td><?= $data['tgl_agenda'] ?></td>
				<td><?= $data['no_agenda'] ?></td>
				<td><?= $data['no_surat'] ?></td>
				<td><?= $data['tgl_surat'] ?></td>
				<td><?= $data['asal_surat'] ?></td>
				<td><?= $data['perihal'] ?></td>
				<td><?= $data['lampiran'] ?></td>
				<td><?= $data['status_surat'] ?></td>
				<td><?= $data['diteruskan'] ?></td>
			</tr>
		<?php }; ?>

	</table>
	<?php
	echo $data1;
	exit(); ?>
</body>

</html>