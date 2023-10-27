<?= $this->extend('admin/layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">
    <div class="container-fluid d-flex mt-3">
        <div class="row row-cols-2">
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sekolah
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" name="sekolah">
                                    4 <span>Sekolah</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Siswa
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" name="card-ssw">
                                    12 <span>Siswa</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Active User
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" name="aktif">
                                    6 <span>Active</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Universitas
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" name="univ">
                                    3 <span>Universitas</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Mahasiswa
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" name="card-mhs">
                                    9 <span>Mahasiswa</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title text-dark px-1 rounded-top mt-2 pl-3">Update Absen Bulan Ini</div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="">Data User</th>
                            <th class="" style="width: 100px;">Hadir</th>
                            <th class="" style="width: 100px;">Izin</th>
                            <th class="" style="width: 100px;">Sakit</th>
                            <th class="" style="width: 100px;">Tidak Masuk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataAbsen as $v) {
                            $nomor = 1; ?>
                            <tr>
                                <td class="dashboard"><img src="ikura.jpeg" alt="" />
                                    <div class="wrapper-tdSatu">
                                        <p class="dashboard nama" name="nama">
                                            <?= $v['nama_lengkap']; ?>
                                        </p>
                                        <p class="dashboard ssw" name="ssw">
                                            <?= $v['nama_instansi']; ?>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <?= $v['nama_lengkap']; ?>
                                </td>
                                <td>SSW</td>
                                <td>08.13</td>
                            </tr>
                            <?php $nomor++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>