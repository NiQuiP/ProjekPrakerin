<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | My Profile</title>
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/style-pr.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <script src="https://kit.fontawesome.com/fb6ebd8b45.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap"
        rel="stylesheet" />
</head>

<body class="container">
    <!-- Sidebar -->
    <nav>
        <div class="wrapperNav">
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
                    <li class="nav-link" id="aktif">
                        <a href="#"> My Profile </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?= site_url('member/attendance') ?>"> Attendance Form </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?= site_url('member/permission') ?>"> Permission Form</a>
                    </li>
                    <li class="nav-link">
                        <a href="<?= site_url('member/history') ?>"> History Absen </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?= site_url('member/setting') ?>"> Settings & Privacy </a>
                    </li>
                </ul>
            </main>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="container-content">
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
                    <a href="#">Lihat Profile</a>
                </div>
                <div class="wrapper-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="<?= site_url('member/logout') ?>">Keluar</a>
                </div>
            </div>
        </header>
        <header class="second">
            <div class="text">
                <?= $title; ?>
            </div>
        </header>
        <main class="wrapper-content">
            <div class="container-profile">
                <div class="wrapper-profile">
                    <div class="profile-body">
                        <img src="<?= base_url(LOKASI_UPLOAD . '/' . $namaFile) ?>" alt="" />
                    </div>
                </div>
            </div>
            <div class="wrapper-identity">
                <form action="">

                    <div class="identitas">
                        <label for="nama">Nama Lengkap: </label>
                        <input type="text" name="nama_lengkap" id="nama" readonly
                            value="<?= session()->get('member_nama_lengkap') ?>" />
                    </div>
                    <div class="identitas">
                        <label for="nis">NIS/NIM : </label>
                        <input type="text" name="" id="" value="<?= session()->get('member_nim_nis') ?>" readonly />
                    </div>
                    <div class="identitas">
                        <label for="username">Username : </label>
                        <input type="text" name="" id="" value="<?= session()->get('member_username') ?>" readonly />
                    </div>
                    <div class="identitas">
                        <label for="jenis-kelamin">Jenis Kelamin : </label>
                        <input type="text" name="jenis_kelamin" value="<?= session()->get('member_jenis_kelamin') ?>"
                            readonly>
                    </div>
                    <div class="identitas">
                        <label for="telepon">No. Telepon :</label>
                        <input type="tel" name="no_hp" id="" value="<?= session()->get('member_no_hp') ?>" readonly />
                    </div>
                    <div class="identitas">
                        <label for="email">Email :</label>
                        <input type="email" name="" id="" value="<?= session()->get('member_email') ?>" readonly />
                    </div>
                    <div class="identitasInstansi" id="instansi">
                        <div class="instansiAsal">
                            <label for="Instansi">Instansi Pendidikan :</label>
                            <input type="text" name="instansi" value="<?= session()->get('member_instansi') ?>"
                                readonly>
                        </div>
                        <div class="instansiNama">
                            <label for="namaInstansi">Nama Instansi :</label>
                            <input type="text" name="nama_instansi" id=""
                                value="<?= session()->get('member_nama_instansi') ?>" readonly />
                        </div>
                    </div>

                </form>
            </div>
        </main>
    </main>

    <script src="<?= base_url('admin') ?>/js/script-pr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')): ?>
            Swal.fire({
                icon: '<?= session()->getFlashdata('swal_icon'); ?>',
                title: '<?= session()->getFlashdata('swal_title'); ?>',
            })
        <?php endif; ?>
    </script>
</body>

</html>