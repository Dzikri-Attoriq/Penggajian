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
		<h2>Laporan Gaji Pegawai</h2>
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

	<table class="table table-bordered table-striped table-responsive-md">
            <tr>
                <td class="text-center">NO</td>
                <td class="text-center">NIK</td>
                <td class="text-center">Nama Pegawai</td>
                <td class="text-center">Jenis Kelamin</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">Gaji Pokok</td>
                <td class="text-center">Tunjangan Transportasi</td>
                <td class="text-center">Uang Makan</td>
                <td class="text-center">Potongan</td>
                <td class="text-center">Total Gaji</td>
            </tr>

            <?php  
                $potAlpha = $alpha['jml_potongan'];
                $potIzin = $izin['jml_potongan'];
                $potSakit = $sakit['jml_potongan']
            ?>

            <?php $no=1; foreach($cetakGaji as $g) : ?>
            <?php  
            $potongan1 = $potAlpha * $g->alpha;
            $potongan2 = $potIzin * $g->izin;
            $potongan3 = $potSakit * $g->sakit;
            $potongan = $potongan1 + $potongan2 + $potongan3;
            $total = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potongan;
            ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $g->nik; ?></td>
                    <td><?= $g->nama_pegawai; ?></td>
                    <td><?= $g->jenis_kelamin; ?></td>
                    <td><?= $g->nama_jabatan; ?></td>
                    <td>Rp.<?= number_format($g->gaji_pokok,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($g->tj_transport,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($g->uang_makan,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($potongan,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($total,0,',','.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
	
	<script>
		window.print();
	</script>

</body>
</html>
