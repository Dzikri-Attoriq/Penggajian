    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mx-auto " style="width: 35%;">
            <div class="card-header bg-primary text-white text-center">
                Filter Laporan Absensi
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/LaporanAbsensi/cetakLaporanAbsensi'); ?>" method="POST">
                    <div class="form-group row">
                        <label for="bulan" class="col-sm-3 col-form-label">Bulan :</label>
                        <div class="col-sm-9">
                          <select name="bulan" id="bulan" class="form-control text-center">
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
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun :</label>
                        <div class="col-sm-9">
                          <select name="tahun" id="tahun" class="form-control text-center">
                            <option value="">>-- Pilih Tahun --<</option>
                            <?php $tahun = date('Y');
                                for ($i=2022; $i < $tahun+5 ; $i++) :
                             ?>
                                <option value="<?= $i; ?>"> <?= $i; ?> </option>
                            <?php endfor; ?>
                        </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;"><i class="fas fa-print"></i> Cetak Laporan Absensi</button>
                </form>
            </div>
        </div>

        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->