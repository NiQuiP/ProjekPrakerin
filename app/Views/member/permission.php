<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Attendance Form</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/permission.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
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
                    <li class="nav-link">
                        <a href="<?= site_url('member/my-profile') ?>"> My Profile </a>
                    </li>
                    <li class="nav-link">
                        <a href="<?= site_url('member/attendance') ?>"> Attendance Form </a>
                    </li>
                    <li class="nav-link" id="aktif">
                        <a href="#"> Permission Form</a>
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
                    <a href="<?= site_url('member/my-profile') ?>">Lihat Profile</a>
                </div>
                <div class="wrapper-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="<?= base_url('member/logout') ?>">Keluar</a>
                </div>
            </div>
        </header>
        <header class="second">
            <div class="text">Permission Form</div>
        </header>
        <main class="wrapper-content">
            <div class="wrapper-body">
                <div class="body-satu">
                    <div class="date">
                        <div class="text">Waktu & Tanggal</div>
                        <div class="date-time">
                            <h3 id="current-time"></h3>
                            <h3 id="date-today"></h3>
                        </div>
                    </div>
                </div>
                <div class="body-dua">
                    <form action="<?= route_to('user.permission') ?>" method="post" enctype="multipart/form-data">
                        <div class="grid-satu">
                            <div class="wrapper-bukti">
                                <div class="wrapper-izin">
                                    <select name="menu" id="menu" onchange="updateValue()">
                                        <option value="" hidden></option>
                                        <option value="Izin">Izin</option>
                                        <option value="Sakit">Sakit</option>
                                    </select>
                                </div>
                                <div class="wrapper-image">
                                    <div class="profile-body">
                                        <img id="preview" src="#" alt="File yang anda masukan bukan gambar" />
                                    </div>
                                    <div class="text">
                                        <label for="upload" class="uploud-image">Pilih Gambar</label>
                                    </div>
                                    <input required name="foto_absen" type="file" id="upload" accept=".png, .jpg, .jpeg"
                                        style="display: none; visibility: hidden" />
                                </div>
                            </div>
                            <div class="wrapper-maps">
                                <div id="map"></div>
                            </div>
                        </div>
                        <div class="grid-dua">
                            <div class="wrapper">
                                <div class="textareaWrapper">
                                    <h3>Keterangan :</h3>
                                    <textarea name="keterangan" id="" cols="30" rows="10"
                                        placeholder="Isi Disini..."></textarea>
                                </div>
                                <div class="kbWrapper">
                                    <div class="kordinatWrapper">
                                        <div class="lat">latitude <span>:</span>
                                            <input name="lat" type="text" id="latitude" readonly /> <br />
                                        </div>
                                        <div class="long">longitude <span>:</span>
                                            <input name="long" type="text" id="longitude" readonly />
                                        </div>
                                    </div>
                                    <div class="buttonWrapper">
                                        <input type="submit" name="submit" value="Check-In">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </main>

    <!-- Js -->
    <script src="<?= base_url('admin') ?>/js/perms.js"></script>
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