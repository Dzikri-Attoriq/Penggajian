    <!-- Begin Page Content -->
    <div class="container-fluid">

        <?php  
        if((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '') ) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['tahun']) && $_GET['tahun'] != '') {
            $bulan = date('F');
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else {
            $bulan = date('F');
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        }
        ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <?= $this->session->flashdata('pesan'); ?>

        <!-- Content Row -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            Filter Data Gaji Pegawai
          </div>
          <div class="card-body">
            <form class="form-inline">
              <div class="form-group mb-2">
                <label for="bulan" class="mr-2">Bulan:</label>
                <select name="bulan" id="bulan" class="form-control">
                    <option value="">>-- Pilih Bulan --<</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
              </div>
              <div class="form-group mx-sm-5 mb-2">
                <label for="tahun" class="mr-2">Tahun:</label>
                <select name="tahun" id="tahun" class="form-control">
                    <option value="">>-- Pilih Tahun --<</option>
                    <?php $tahunSelect = date('Y');
                        for ($i=2022; $i < $tahunSelect+5 ; $i++) :
                     ?>
                        <option value="<?= $i; ?>"> <?= $i; ?> </option>
                    <?php endfor; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tamplikan Data</button>
              <?php if (count($gaji) > 0): ?>
                    <a href="<?= base_url('admin/DataPenggajian/cetakGaji?bulan='.$bulan.'&tahun='.$tahun); ?>" class="btn btn-success mb-2 ml-3"><i class="fas fa-print"></i> Cetak Daftar Gaji</a>
              <?php else: ?>
                    <button type="button" class="btn btn-success mb-2 ml-3" data-toggle="modal" data-target="#exampleModal">
                      <i class="fas fa-print"></i> Cetak Daftar Gaji
                    </button>
              <?php endif ?>
            </form>
          </div>
        </div>

        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          Menampilkan Data Gaji Pegawai Bulan: <span class="font-weight-bold"><?= $bulan; ?></span> Tahun: <span class="font-weight-bold"><?= $tahun; ?></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <?php 
        $jml_data = count($gaji);
        if ($jml_data > 0): 
        ?>

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

            <?php $no=1; foreach($gaji as $g) : ?>
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
        <?php else: ?>
            <div class="badge badge-danger alert"><i class="fas fa-info-circle"></i> Data masih kosng, silahkan input data kehadiran pada bulan <span class="font-weight-bold"><?= $bulan; ?></span> tahun <span class="font-weight-bold"><?= $tahun; ?></span></div>
        <?php endif; ?>

    </div>
    <!-- /.container-fluid -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            <i class="fas fa-info-circle"></i> Informasi
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data Gaji Masih Kosong, silahkan input absensi pada Bulan: <span class="font-weight-bold"><?= $bulan; ?></span> Tahun: <span class="font-weight-bold"><?= $tahun; ?></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a class="btn btn-primary" href="<?= base_url('admin/DataAbsensi/inputAbsensi?bulan='.$bulan.'&tahun='.$tahun); ?>">Input Absensi</a>
      </div>
    </div>
  </div>
</div>