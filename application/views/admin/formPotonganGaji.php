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
                <a href="<?= base_url('admin/PotonganGaji'); ?>" class="btn btn-info btn-flat float-right">
                <i class="fas fa-undo"></i> Back
              </a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/PotonganGaji/tambahDataAksi'); ?>" method="POST">
                    
                    <div class="row">
                        <div class="col-md-5 mx-auto">
                            <div class="form-group">
                                <label for="potongan" class="pl-1">Jenis Potongan</label>
                                <input type="text" name="potongan" id="potongan" class="form-control" value="<?= set_value('potongan'); ?>">
                                <?= form_error('potongan','<small class="text-danger pl-3">','</small>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="jml_potongan" class="pl-1">Jumlah Potongan</label>
                                <input type="text" name="jml_potongan" id="jml_potongan" class="form-control" value="<?= set_value('jml_potongan'); ?>">
                                <?= form_error('jml_potongan','<small class="text-danger pl-3">','</small>'); ?>
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