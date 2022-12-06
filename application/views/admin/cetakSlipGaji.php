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
		<h2>Slip Gaji Pegawai</h2>
		<hr style="width: 50%; border-width: 5px; color: black;" >
	</center>

	<?php  
		$bulan = $this->input->post('bulan', TRUE);
		$tahun = $this->input->post('tahun', TRUE);

        $potAlpha = $alpha['jml_potongan'];
        $potIzin = $izin['jml_potongan'];
        $potSakit = $sakit['jml_potongan']
    ?>

	<?php $no=1; foreach($printSlip as $p) : ?>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md">
			<table style="width: 100%;" class="mt-2">
				<tr>
					<td style="width: 10%;">NIK</td>
					<td style="width: 1%;">:</td>
					<td><?= $p->nik ?></td>
				</tr>
				<tr>
					<td>Nama Pegawai</td>
					<td>:</td>
					<td><?= $p->nama_pegawai ?></td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<td><?= $p->nama_jabatan ?></td>
				</tr>
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
		</div>
	</div>

	<?php   
	    $potongan1 = $potAlpha * $p->alpha;
	    $potongan2 = $potIzin * $p->izin;
	    $potongan3 = $potSakit * $p->sakit;
	    $potongan = $potongan1 + $potongan2 + $potongan3;
	    $total = $p->gaji_pokok + $p->tj_transport + $p->uang_makan - $potongan;
    ?>

	<div class="row">
		<div class="col-md-8 mx-auto">
			<table class="table table-bordered table-striped mt-3">
				<tr class="text-center">
					<th width="5%">NO</th>
					<th>Keterangan</th>
					<th>Jumlah</th>
				</tr>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td>Gaji Pokok</td>
					<td>Rp.<?= number_format($p->gaji_pokok,0,',','.'); ?></td>
				</tr>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td>Tunjangan Transport</td>
					<td>Rp.<?= number_format($p->tj_transport,0,',','.'); ?></td>
				</tr>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td>Uang Makan</td>
					<td>Rp.<?= number_format($p->uang_makan,0,',','.'); ?></td>
				</tr>
				<tr>
					<td class="text-center"><?= $no++; ?></td>
					<td>Potongan Gaji</td>
					<td>Rp.<?= number_format($potongan,0,',','.'); ?></td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">Total Gaji</td>
					<td>Rp.<?= number_format($total,0,',','.'); ?></td>
				</tr>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 mx-auto mt-4">
			<div class="row">
				<div class="col-md-4 text-center">
						<p>Pegawai</p>
						<br><br>
						<p class="font-weight-bold"><?= $p->nama_pegawai; ?></p>
					</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<p>Penajam, <?= date('d F Y'); ?><br> Finance</p>
					<br>
					<p>___________________</p>
				</div>
			</div>
		</div>
	</div>

	<?php endforeach; ?>
	

	   

	

	

	
	<script>
		window.print();
	</script>

</body>
</html>
