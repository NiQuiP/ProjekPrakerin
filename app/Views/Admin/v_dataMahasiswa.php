<?= $this->extend('admin/layout/v_template'); ?>

<?= $this->section('content'); ?>
<!-- Begin Page Content -->

<div class="container-fluid">
    <h1 class="mt-3 text-dark font-weight-bold">Mahasiswa</h1>
    <div class="wrapper-addUser text-dark bg-info d-flex w-25 p-2 my-3 rounded-lg shadow-sm">
        <input type="button" id="but" hidden></input>
        <label for="but"> <i class="fa-solid fa-circle-plus mr-2"></i> Tambah User Baru</label>
    </div>
    <!-- DataTales Example -->
    <div class="title text-dark px-1 rounded-top mt-5 pl-3">Data Tables Mahasiswa</div>
    <div class="card shadow mb-2">
        <div class="card-body border-bottom">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Asal Instansi</th>
                            <th>Username</th>
                            <th>Jenis Kelamin</th>
                            <th>Gambar</th>
                            <th>NIS</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataMahasiswa as $v) {
                            ?>
                            <tr>
                                <td>
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <?= $v['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <?= $v['nama_instansi']; ?>
                                </td>
                                <td>
                                    <?= $v['username']; ?>
                                </td>
                                <td>
                                    <?= $v['jenis_kelamin']; ?>
                                </td>
                                <td>
                                    <?= $v['foto']; ?>
                                </td>
                                <td>
                                    <?= $v['nim_nis']; ?>
                                </td>
                                <td>$320,800</td>
                                <td>
                                    <a href="#" class="btn btn-danger btn-circle mb-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle mb-1">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        } ?>
                    </tbody>
                </table>
                <?= $pager->links('mahasiswa', 'absensitable'); ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?= $this->endSection(); ?>