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
        <a href="<?= base_url('admin/DataJabatan/tambahData'); ?>" class="btn btn-success btn-sm mb-3"> 
            <i class="fas fa-plus"></i> Tambah Jabatan
        </a>

        <table class="table table-bordered table-striped table-responsive-md">
            <tr>
                <th class="text-center">NO</th>
                <th class="text-center">Nama Jabatan</th>
                <th class="text-center">Gaji Pokok</th>
                <th class="text-center">Tunjangan Transportasi</th>
                <th class="text-center">Uang Makan</th>
                <th class="text-center">Total</th>
                <th class="text-center">Action</th>
            </tr>

            <?php $no=1; foreach($jabatan as $j) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= $j->nama_jabatan; ?></td>
                    <td>Rp.<?= number_format($j->gaji_pokok,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($j->tj_transport,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($j->uang_makan,0,',','.'); ?></td>
                    <td>Rp.<?= number_format($j->uang_makan + $j->gaji_pokok + $j->tj_transport,0,',','.'); ?></td>
                    <td>
                        <center>
                            <a href="<?= base_url('admin/DataJabatan/updateData/'.$j->id_jabatan); ?>" class="btn btn-primary btn-sm"> 
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/DataJabatan/deleteData/'.$j->id_jabatan); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda benar-benar ingin menghapus data?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </table>

    </div>
    <!-- /.container-fluid -->