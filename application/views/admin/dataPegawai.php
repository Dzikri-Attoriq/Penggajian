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
        <a href="<?= base_url('admin/DataPegawai/tambahData'); ?>" class="btn btn-success btn-sm mb-3"> 
            <i class="fas fa-plus"></i> Tambah Pegawai 
        </a>

        <table class="table table-bordered table-striped table-responsive-md">
            <tr>
                <th class="text-center">NO</th>
                <th class="text-center">Photo</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center">Gender</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Tanggal Masuk</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>

            <?php $no=1; foreach($pegawai as $p) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td>
                        <img src="<?= base_url('assets/img/profile/').$p->foto; ?>" alt="" width="80" height="80">
                    </td>
                    <td><?= $p->nik; ?></td>
                    <td><?= $p->nama_pegawai; ?></td>
                    <td><?= $p->jenis_kelamin; ?></td>
                    <td><?= $p->jabatan; ?></td>
                    <td><?= $p->tanggal_masuk; ?></td>
                    <td><?= $p->status; ?></td>
                    <td>
                        <center>
                            <a href="<?= base_url('admin/DataPegawai/updateData/'.$p->id_pegawai); ?>" class="btn btn-primary btn-sm"> 
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="<?= base_url('admin/DataPegawai/deleteData/'.$p->id_pegawai); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda benar-benar ingin menghapus data?')">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </table>

    </div>
    <!-- /.container-fluid -->