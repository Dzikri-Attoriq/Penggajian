    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <?= $this->session->flashdata('pesan'); ?>

        <!-- Content Row -->
        <div class="card">
            <div class="card-body">
                <form action="<?= base_url('GantiPassword/gantiPasswordAksi'); ?>" method="POST">
                    
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <div class="form-group">
                                <label for="passnow" class="pl-1">Password Sebelumnya</label>
                                <input type="password" name="passnow" id="passnow" class="form-control" value="<?= set_value('passnow'); ?>">
                                <?= form_error('passnow','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="passnew" class="pl-1">Password Baru</label>
                                    <input type="password" name="passnew" id="passnew" class="form-control" value="<?= set_value('passnew'); ?>">
                                    <?= form_error('passnew','<small class="text-danger pl-3">','</small>'); ?>
                                </div>

                                <div class="col-md-6">
                                    <label for="passconf" class="pl-1">Konfirmasi Password Baru</label>
                                    <input type="password" name="passconf" id="passconf" class="form-control" value="<?= set_value('passconf'); ?>">
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