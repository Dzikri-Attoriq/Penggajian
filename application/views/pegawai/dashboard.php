    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header font-weight-bold bg-primary text-white">
                        Data <?= $pegawai['jenis_kelamin'] == "Perempuan" ? "Ibu" : "Bapak"; ?> <?= $pegawai['nama_pegawai']; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="<?= base_url('assets/img/profile/').$pegawai['foto']; ?>" alt="" class="img-thumbnail" style="width: 300px; height: 280px;">
                            </div>
                            <div class="col-md-7 mt-4">
                                <table class="table">
                                    <tr>
                                        <td>NIK</td>
                                        <td>:</td>
                                        <td><?= $pegawai['nik']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pegawai</td>
                                        <td>:</td>
                                        <td><?= $pegawai['nama_pegawai']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jabatan</td>
                                        <td>:</td>
                                        <td><?= $pegawai['jabatan']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Masuk</td>
                                        <td>:</td>
                                        <td><?= $pegawai['tanggal_masuk']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td><?= $pegawai['status']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->