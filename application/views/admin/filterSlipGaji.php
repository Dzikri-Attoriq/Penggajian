    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card mx-auto " style="width: 41%;">
            <div class="card-header bg-primary text-white text-center">
                Filter Slip Gaji Pegawai
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/SlipGaji/cetakSlipGaji'); ?>" method="POST">
                    <div class="form-group row">
                        <label for="bulan" class="col-sm-6 col-form-label">Masukkan Bulan :</label>
                        <div class="col-sm-6">
                          <select name="bulan" id="bulan" class="form-control text-center">
                            <option value="">>-- Pilih Bulan --<</option>
                            <option value="January" <?= set_value('bulan') == "January" ? "selected" : null; ?>>January</option>
                            <option value="February" <?= set_value('bulan') == "February" ? "selected" : null; ?>>February</option>
                            <option value="March" <?= set_value('bulan') == "March" ? "selected" : null; ?>>March</option>
                            <option value="April" <?= set_value('bulan') == "April" ? "selected" : null; ?>>April</option>
                            <option value="May" <?= set_value('bulan') == "May" ? "selected" : null; ?>>May</option>
                            <option value="June" <?= set_value('bulan') == "June" ? "selected" : null; ?>>June</option>
                            <option value="July" <?= set_value('bulan') == "July" ? "selected" : null; ?>>July</option>
                            <option value="August" <?= set_value('bulan') == "August" ? "selected" : null; ?>>August</option>
                            <option value="September" <?= set_value('bulan') == "September" ? "selected" : null; ?>>September</option>
                            <option value="October" <?= set_value('bulan') == "October" ? "selected" : null; ?>>October</option>
                            <option value="November" <?= set_value('bulan') == "November" ? "selected" : null; ?>>November</option>
                            <option value="December" <?= set_value('bulan') == "December" ? "selected" : null; ?>>December</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-6 col-form-label">Masukkan Tahun :</label>
                        <div class="col-sm-6">
                          <select name="tahun" id="tahun" class="form-control text-center">
                            <option value="">>-- Pilih Tahun --<</option>
                            <?php $tahun = date('Y');
                                for ($i=2022; $i < $tahun+5 ; $i++) :
                             ?>
                                <option value="<?= $i; ?>" <?= set_value('tahun') == $i ? "selected" : null; ?>> <?= $i; ?> </option>
                            <?php endfor; ?>
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_pegawai" class="col-sm-6 col-form-label">Masukkan Nama Pegawai :</label>
                        <div class="col-sm-6">
                          <select name="nama_pegawai" id="nama_pegawai" class="form-control text-center">
                            <option value="">>-- Pilih Pegawai --<</option>
                            <?php foreach ($pegawai as $p): ?>
                                <option value="<?= $p->nama_pegawai; ?>"> <?= $p->nama_pegawai; ?> </option>
                            <?php endforeach ?>
                        </select>
                        <?= form_error('nama_pegawai','<small class="text-danger pl-3">','</small>'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;"><i class="fas fa-print"></i> Cetak Slip Gaji</button>
                </form>
            </div>
        </div>

        <!-- Content Row -->

    </div>
    <!-- /.container-fluid -->