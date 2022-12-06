    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <table class="table table-bordered table-striped table-responsive-md">
            <tr class="text-center">
                <th>Bulan/tahun</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan Transportasi</th>
                <th>Uang Makan</th>
                <th>Potongan Gaji</th>
                <th>Total Gaji</th>
                <th>Cetak Slip Gaji</th>
            </tr>
            <?php  
            $alp = $alpha['jml_potongan'];
            $iz = $izin['jml_potongan'];
            $sak = $sakit['jml_potongan'];
            ?>
            <?php foreach ($gaji as $g): 
                $potonganAlpha = $alp * $g->alpha;
                $potonganIzin = $iz * $g->izin;
                $potonganSakit = $sak * $g->sakit;
                $potongan = $potonganAlpha + $potonganIzin + $potonganSakit;
                $jumlah = $g->tj_transport + $g->gaji_pokok + $g->uang_makan - $potongan;
            ?>
                <tr>
                    <td><?= $g->bulan; ?></td>
                    <td>Rp.<?= number_format($g->gaji_pokok ,0, ',','.'); ?></td>
                    <td>Rp.<?= number_format($g->tj_transport ,0, ',','.'); ?></td>
                    <td>Rp.<?= number_format($g->uang_makan ,0, ',','.'); ?></td>
                    <td>Rp.<?= number_format($potongan ,0, ',','.'); ?></td>
                    <td>Rp.<?= number_format($jumlah ,0, ',','.'); ?></td>
                    <td>
                        <center>
                            <a href="<?= base_url('pegawai/DataGaji/cetakSlip/').$g->id_kehadiran; ?>" class="btn btn-md btn-primary">
                                <i class="fas fa-print"></i> Cetak
                            </a>
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>
    <!-- /.container-fluid -->