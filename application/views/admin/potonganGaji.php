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
        <a href="<?= base_url('admin/PotonganGaji/tambahData'); ?>" class="btn btn-success btn-sm mb-3"> 
            <i class="fas fa-plus"></i> Tambah Potongan
        </a>

        <table class="table table-bordered table-striped table-responsive-md">
            <tr>
                <th class="text-center" width="4%">NO</th>
                <th class="text-center">Jenis Potongan</th>
                <th class="text-center">Jumlah Potongan</th>
                <th class="text-center">Action</th>
            </tr>

            <?php $no=1; foreach($potGaji as $p) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $p->potongan; ?></td>
                    <td>Rp.<?= number_format($p->jml_potongan,0,',','.'); ?></td>
                    <td>
                        <center>
                            <a href="<?= base_url('admin/PotonganGaji/updateData/'.$p->id); ?>" class="btn btn-primary btn-sm"> 
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/PotonganGaji/deleteData/'.$p->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda benar-benar ingin menghapus data?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </table>

    </div>
    <!-- /.container-fluid -->