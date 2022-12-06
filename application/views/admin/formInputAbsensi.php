    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="card mb-3">
          <div class="card-header bg-primary text-white">
            Input Data Absensi
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
                    <?php $tahun = date('Y');
                        for ($i=2022; $i < $tahun+5 ; $i++) :
                     ?>
                        <option value="<?= $i; ?>"> <?= $i; ?> </option>
                    <?php endfor; ?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Generate</button>
              <a href="<?= base_url('admin/DataAbsensi'); ?>" class="btn btn-info mb-2 ml-3"><i class="fas fa-undo"></i> Back</a>
            </form>
          </div>
        </div>

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

        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          Menampilkan Input Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?= $bulan; ?></span> Tahun: <span class="font-weight-bold"><?= $tahun; ?></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <?php if (count($inputAbsensi) > 0): ?>
            <form action="" method="POST">
                <table class="table table-bordered table-striped table-responsive-md">
                    <tr>
                        <td class="text-center">NO</td>
                        <td class="text-center">NIK</td>
                        <td class="text-center">Nama Pegawai</td>
                        <td class="text-center">Jenis Kelamin</td>
                        <td class="text-center">Jabatan</td>
                        <td class="text-center" width="9%">Hadir</td>
                        <td class="text-center" width="9%">Sakit</td>
                        <td class="text-center" width="9%">Izin</td>
                        <td class="text-center" width="9%">Alpha</td>
                    </tr>

                    <?php $no=1; foreach($inputAbsensi as $a) : ?>
                        <tr>
                            <input type="hidden" name="bulan[]" class="form-control" value="<?= $bulanTahun; ?>">
                            <input type="hidden" name="nik[]" class="form-control" value="<?= $a->nik; ?>">
                            <input type="hidden" name="nama_pegawai[]" class="form-control" value="<?= $a->nama_pegawai; ?>">
                            <input type="hidden" name="jenis_kelamin[]" class="form-control" value="<?= $a->jenis_kelamin; ?>">
                            <input type="hidden" name="nama_jabatan[]" class="form-control" value="<?= $a->nama_jabatan; ?>">

                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $a->nik; ?></td>
                            <td><?= $a->nama_pegawai; ?></td>
                            <td><?= $a->jenis_kelamin; ?></td>
                            <td><?= $a->nama_jabatan; ?></td>
                            <td><input type="number" name="hadir[]" class="form-control" value="0"></td>
                            <td><input type="number" name="sakit[]" class="form-control" value="0"></td>
                            <td><input type="number" name="izin[]" class="form-control" value="0"></td>
                            <td><input type="number" name="alpha[]" class="form-control" value="0"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                    <button type="submit" class="btn btn-success" name="submit" value="submit">
                        <i class="fas fa-save"></i> Simpan Data Absensi
                    </button>
            </form>
        <?php else: ?>
            <div class="badge badge-danger alert"><i class="fas fa-info-circle"></i> Data kehadiran pada bulan <span class="font-weight-bold"><?= $bulan; ?></span> tahun <span class="font-weight-bold"><?= $tahun; ?></span> telah di input.</div>
        <?php endif; ?>

    </div>
    <!-- /.container-fluid -->