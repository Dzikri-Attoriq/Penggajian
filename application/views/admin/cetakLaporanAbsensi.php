<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title; ?></title>
	<style>
		body {
			font-family: arial;
			color: black;
		}
	</style>
</head>
<body>
	<center>
		<h1>Penajam Paser Utara</h1>
		<h2>Laporan Absensi Pegawai</h2>
	</center>

	<?php  
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
	?>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?= $bulan == null ? date('F') : $bulan ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?= $tahun == null ? date('Y') : $tahun ?></td>
		</tr>
	</table>

	<table class="table table-bordered table-striped">
		<tr>
			<th class="text-center">NO</th>
			<th class="text-center">NIK</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Jenis Kelamin</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Hadir</th>
			<th class="text-center">Sakit</th>
			<th class="text-center">Izin</th>
			<th class="text-center">Alpha</th>
		</tr>

		<?php $no=1; foreach ($lapKehadiran as $l ): ?>
			<tr>
				<td class="text-center"><?= $no++; ?></td>
				<td><?= $l->nik; ?></td>
				<td><?= $l->nama_pegawai; ?></td>
				<td><?= $l->nama_jabatan; ?></td>
				<td><?= $l->jenis_kelamin; ?></td>
				<td class="text-center"><?= $l->hadir; ?></td>
				<td class="text-center"><?= $l->sakit; ?></td>
				<td class="text-center"><?= $l->izin; ?></td>
				<td class="text-center"><?= $l->alpha; ?></td>
			</tr>
		<?php endforeach; ?>

	</table>
	
	<script>
		window.print();
	</script>

</body>
</html>
