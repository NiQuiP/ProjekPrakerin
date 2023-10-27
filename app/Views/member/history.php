
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | History Absen</title>
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/style-ha.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap"
        rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body class="kontainer">
    <!-- Sidebar -->
    <nav>
        <header>
            <div class="text">
                <h1>
                    <?= session()->get('member_nama_lengkap') ?>
                </h1>
                <h2>
                    <?= session()->get('member_nama_instansi') ?>
                </h2>
            </div>
        </header>
        <main>
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="<?= site_url('member/my-profile') ?>"> My Profile </a>
                </li>
                <li class="nav-link">
                    <a href="<?= site_url('member/attendance') ?>"> Attendance Form </a>
                </li>
                <li class="nav-link">
                    <a href="<?= site_url('member/permission') ?>"> Permission Form</a>
                </li>
                <li class="nav-link" id="aktif">
                    <a href="#"> History Absen </a>
                </li>
                <li class="nav-link">
                    <a href="<?= site_url('member/setting') ?>"> Settings & Privacy </a>
                </li>
            </ul>
        </main>
    </nav>
    <!-- Main Content -->
    <main class="kontainer-content">
        <?php $namaFile = session()->get('member_foto') ?>
        <div class="wrapper-icon">
            <i class="bx bx-menu"></i>
        </div>
        <header class="first">
            <div class="wrapper-name">
                <div class="user-text">
                    <?= session()->get('member_username') ?>
                </div>
                <div class="user-profile">
                    <img src="<?= base_url(LOKASI_UPLOAD . '/' . $namaFile) ?>" alt="" />
                </div>
            </div>
            <div class="dropdownMenu">
                <div class="wrapper-user">
                    <img src="<?= base_url(LOKASI_UPLOAD . '/' . $namaFile) ?>" alt="" />
                    <div class="userText">
                        <?= session()->get('member_username') ?>
                    </div>
                </div>
                <div class="wrapper-a">
                    <a href="<?= site_url('member/my-profile') ?>">Lihat Profile</a>
                </div>
                <div class="wrapper-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="<?= base_url('member/logout') ?>">Keluar</a>
                </div>
            </div>
        </header>
        <main class="table">
            <section class="table__header">
                <h1>History Absen</h1>
            </section>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th>Id <span class="icon-arrow">&UpArrow;</span></th>
                            <th>Status<span class="icon-arrow">&UpArrow;</span></th>
                            <th>Nama</th>
                            <th>Location</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dataAbsen as $value) {
                            $nomor = $nomor + 1;
                            ?>
                            <tr>
                                <td>
                                    <?= $nomor; ?>
                                </td>
                                <td>
                                    <div class="status">
                                        <p class="masuk">
                                            <?= $value['status'] ?>
                                        </p>
                                    </div>
                                </td>
                                <td><img src="<?= base_url(LOKASI_UPLOAD . '/' . $namaFile) ?>" alt="" />
                                    <?= $value['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <?= $value['lokasi']; ?>
                                </td>
                                <td>
                                    <?= $value['waktu_absen']; ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
                $linkPagination = $pager->links();
                $linkPagination = str_replace('<li class="active">', '<li class="page-item active">', $linkPagination);
                $linkPagination = str_replace('<li>', '<li class="page-item">', $linkPagination);
                $linkPagination = str_replace('<a', '<a class="page-link"', $linkPagination);
                echo $linkPagination;
                ?>
            </section>
        </main>
    </main>
    <script src="<?= base_url('admin') ?>/js/script-ha.js"></script>
</body>

</html>