    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('admin/DataPegawai'); ?>" class="btn btn-info btn-flat float-right">
                <i class="fas fa-undo"></i> Back
              </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/DataPegawai/tambahDataAksi'); ?>" method="POST" enctype="multipart/form-data">
                    
                    <div class="row">
                        <div class="col-md-5 mx-auto">

                            <div class="form-group">
                                <label for="nik" class="pl-1">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" value="<?= set_value('nik'); ?>">
                                <?= form_error('nik','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_pegawai" class="pl-1">Nama Pegawai</label>
                                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?= set_value('nama_pegawai'); ?>">
                                <?= form_error('nama_pegawai','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="username" class="pl-1">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
                                <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="password" class="pl-1">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
                                <?= form_error('password','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin" class="ml-3">Gender</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control text-center">
                                    <option value="">>-- Pilih Gender --<</option>
                                    <option value="Laki-Laki" <?= set_value('jenis_kelamin') == "Laki-Laki" ? "selected" : null; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?= set_value('jenis_kelamin') == "Perempuan" ? "selected" : null; ?>>Perempuan</option>
                                </select>
                                <?= form_error('jenis_kelamin','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="jabatan" class="ml-3">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control text-center">
                                    <option value="">>-- Pilih Jabatan --<</option>
                                    <?php foreach($jabatan as $j) : ?>
                                    <option value="<?= $j->nama_jabatan; ?>" <?= set_value('jabatan') == $j->nama_jabatan ? "selected" : null; ?>><?= $j->nama_jabatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jabatan','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="status" class="ml-3">Status</label>
                                <select name="status" id="status" class="form-control text-center">
                                    <option value="">>-- Pilih Status --<</option>
                                    <option value="Pegawai Tetap" <?= set_value('status') == "Pegawai Tetap" ? "selected" : null; ?>>Pegawai Tetap</option>
                                    <option value="Pegawai Tidak Tetap" <?= set_value('status') == "Pegawai Tidak Tetap" ? "selected" : null; ?>>Pegawai Tidak Tetap</option>
                                    <option value="Magang" <?= set_value('status') == "Magang" ? "selected" : null; ?>>Magang</option>
                                </select>
                                <?= form_error('status','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="tanggal_masuk" class="pl-1">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?= set_value('tanggal_masuk'); ?>">
                                <?= form_error('tanggal_masuk','<small class="text-danger pl-3">','</small>'); ?>
                                 <small>(boleh kosong)</small> 
                            </div>

                             <div class="form-group row">
                                <div class="col-md-2">
                                   Photo 
                                </div>
                                <div class="col-md-10">
                                    <!-- <div class="row"> -->
                                      <!-- <div class="col-md-3">
                                        <img src="<?= base_url('assets/img/profile/'); ?>" class="img-thumbnail">
                                      </div> -->
                                      <!-- <div class="col-md-9"> -->
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="foto" id="foto" value="<?= set_value('foto'); ?>">
                                          <label for="foto" class="custom-file-label">Pilih file</label>
                                        </div>
                                        <small>(boleh kosong)</small>
                                      <!-- </div> -->
                                    <!-- </div> -->
                                </div>
                            </div>

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fas fa-paper-plane"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->