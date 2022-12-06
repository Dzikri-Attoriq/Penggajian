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
                <a href="<?= base_url('admin/DataJabatan'); ?>" class="btn btn-info btn-flat float-right">
                <i class="fas fa-undo"></i> Back
              </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/DataJabatan/tambahDataAksi'); ?>" method="POST">
                    
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <div class="form-group">
                                <label for="nama_jabatan" class="pl-1">Nama Jabatan</label>
                                <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" value="<?= set_value('nama_jabatan'); ?>">
                                <?= form_error('nama_jabatan','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="gaji_pokok" class="pl-1">Gaji Pokok</label>
                                <input type="text" name="gaji_pokok" id="gaji_pokok" class="form-control" value="<?= set_value('gaji_pokok'); ?>">
                                <?= form_error('gaji_pokok','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="tj_transport" class="pl-1">Tunjangan Transportasi</label>
                                <input type="text" name="tj_transport" id="tj_transport" class="form-control" value="<?= set_value('tj_transport'); ?>">
                                <?= form_error('tj_transport','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="uang_makan" class="pl-1">Uang Makan</label>
                                <input type="text" name="uang_makan" id="uang_makan" class="form-control" value="<?= set_value('uang_makan'); ?>">
                                <?= form_error('uang_makan','<small class="text-danger pl-3">','</small>'); ?>
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