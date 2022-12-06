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
                <form action="<?= base_url('admin/DataPegawai/updateDataAksi'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_pegawai" value="<?= $pegawai['id_pegawai']; ?>">
                    <div class="row">
                        <div class="col-md-5 mx-auto">

                            <div class="form-group">
                                <label for="nik" class="pl-1">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" value="<?= $pegawai['nik']; ?>">
                                <?= form_error('nik','<small class="text-danger pl-3">','</small>'); ?>
                                <?= $this->session->flashdata('error'); ?>
                            </div>

                            <div class="form-group">
                                <label for="nama_pegawai" class="pl-1">Nama Pegawai</label>
                                <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?= $pegawai['nama_pegawai']; ?>">
                                <?= form_error('nama_pegawai','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="username" class="pl-1">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= $pegawai['username']; ?>">
                                <?= form_error('username','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="password1" class="pl-1">Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="password1" name="password1">
                                        <?= form_error('password1','<small class="text-danger pl-3">','</small>'); ?>
                                        <small>(kosongkan jika tidak ingin di ganti)</small>
                                </div>
                                <div class="col-sm-6">
                                    <label for="password2" class="pl-1">Konfirmasi Password</label>
                                    <input type="password" class="form-control form-control-user"
                                        id="password2" name="password2">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin" class="ml-3">Gender</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control text-center">
                                    <option value="<?= $pegawai['jenis_kelamin']; ?>"><?= $pegawai['jenis_kelamin']; ?></option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <?= form_error('jenis_kelamin','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="jabatan" class="ml-3">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control text-center">
                                    <option value="<?= $pegawai['jabatan']; ?>"><?= $pegawai['jabatan']; ?></option>
                                    <?php foreach($jabatan as $j) : ?>
                                    <option value="<?= $j->nama_jabatan; ?>"><?= $j->nama_jabatan; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jabatan','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="status" class="ml-3">Status</label>
                                <select name="status" id="status" class="form-control text-center">
                                    <option value="<?= $pegawai['status']; ?>"><?= $pegawai['status']; ?></option>
                                    <option value="Pegawai Tetap">Pegawai Tetap</option>
                                    <option value="Pegawai Tidak Tetap">Pegawai Tidak Tetap</option>
                                    <option value="Magang">Magang</option>
                                </select>
                                <?= form_error('status','<small class="text-danger pl-3">','</small>'); ?>
                             </div>

                             <div class="form-group">
                                <label for="tanggal_masuk" class="pl-1">Tanggal Masuk</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?= $pegawai['tanggal_masuk']; ?>">
                                <?= form_error('tanggal_masuk','<small class="text-danger pl-3">','</small>'); ?>
                                 <!-- <small>(boleh kosong)</small>  -->
                            </div>

                             <div class="form-group row">
                                <div class="col-md-2">
                                   Photo 
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                      <div class="col-md-3">
                                        <img src="<?= base_url('assets/img/profile/').$pegawai['foto']; ?>" class="img-thumbnail">
                                      </div>
                                      <div class="col-md-9">
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" name="foto" id="foto">
                                          <label for="foto" class="custom-file-label">Pilih file</label>
                                        </div>
                                        <small>(kosongkan jika tidak ingin di ganti)</small>
                                      </div>
                                    </div>
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