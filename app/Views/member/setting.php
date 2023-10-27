<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Privacy</title>
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/style-prvcy.css" />
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
                <li class="nav-link">
                    <a href="<?= site_url('member/history') ?>"> History Absen </a>
                </li>
                <li class="nav-link" id="aktif">
                    <a href="#"> Settings & Privacy </a>
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
        <header class="second">
            <div class="text">Settings & Privacy</div>
        </header>
        <main class="wrapper-content">
            <div class="kontainer-profile">
                <div class="wrapper-profile">
                    <div class="profile-body">
                        <img src="<?= base_url(LOKASI_UPLOAD . '/' . $namaFile) ?>" alt="" />
                    </div>
                </div>
            </div>
            <div class="wrapper-identity">
                <div class="wrapper-form">
                    <?php $validation = \Config\Services::validation() ?>
                    <form action="<?= route_to('user.setting'); ?>" method="post">
                        <div class="identitas">
                            <label for="email">Email : </label>
                            <input type="email" name="email" id="email"
                                class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>"
                                value="<?= (isset($email)) ? $email : '', set_value('email') ?>" />
                            <div class="invalid-feedbak">
                                <h3>
                                    <?= ($validation->getError('email')); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="identitas">
                            <label for="username">Username : </label>
                            <input type="text" name="username" id="username"
                                class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>"
                                value="<?= (isset($username)) ? $username : '', set_value('username') ?>" />
                            <div class="invalid-feedbak">
                                <h3>
                                    <?= ($validation->getError('username')); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="identitas">
                            <label for="password_old">Current Password : </label>
                            <input type="password" name="password_old" id="password_old"
                                class="form-control <?= ($validation->hasError('password_old')) ?>" />
                            <div class="invalid-feedbak">
                                <h3>
                                    <?= ($validation->getError('password_old')); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="identitas">
                            <label for="password_new">New Password : </label>
                            <input type="password" name="password_new" id="password_new"
                                class="form-control <?= ($validation->hasError('password_new')) ?>" />
                            <div class="invalid-feedbak">
                                <h3>
                                    <?= ($validation->getError('password_new')); ?>
                                </h3>
                            </div>
                        </div>
                        <div class="identitas">
                            <label for="konfirmasi_password_new ">Repeat New Password:</label>
                            <input type="password" name="konfirmasi_password_new" id="konfirmasi_password_new"
                                class="form-control <?= ($validation->hasError('konfirmasi_password_new')) ?>" />
                            <div class="invalid-feedbak">
                                <h3>
                                    <?= ($validation->getError('konfirmasi_password_new')); ?>
                                </h3>
                            </div>
                        </div>
                        <input type="submit" name="submit" value="Save" class="button">
                    </form>
                </div>
            </div>
        </main>
    </main>
    <script src="<?= base_url('admin') ?>/js/script-prvcy.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (session()->getFlashdata('swal_icon')): ?>
            Swal.fire({
                position: 'center',
                icon: '<?= session()->getFlashdata('swal_icon'); ?>',
                title: '<?= session()->getFlashdata('swal_title'); ?>',
                showConfirmButton: false,
                timer: 1500
            })
        <?php endif; ?>
    </script>
</body>

</html>