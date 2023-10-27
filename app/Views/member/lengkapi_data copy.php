<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>User | Create Account</title>
  <link rel="stylesheet" href="<?= base_url('admin'); ?>/css/style.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->



  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto+Condensed&display=swap"
    rel="stylesheet" />
</head>

<body class="container">
  <!-- Sidebar -->
  <nav>
    <header>
      <div class="text">
        <h1>(Username)</h1>
        <h2>(Sekolah)</h2>
      </div>
    </header>
    <!-- <main>
        <ul class="menu-links">
          <li class="nav-link">
            <a href="my-profile.html"> My Profile </a>
          </li>
          <li class="nav-link">
            <a href="#"> Attendance Form </a>
          </li>
          <li class="nav-link">
            <a href="#"> History Absen </a>
          </li>
          <li class="nav-link">
            <a href="privacy.html"> Settings & Privacy </a>
          </li>
        </ul>
      </main> -->
  </nav>
  <!-- Main Content -->
  <main class="container-content">
    <header class="first">
      <div class="wrapper-icon">
        <i class="bx bx-menu"></i>
      </div>
      <div class="wrapper-name">
        <div class="user-text">(Nama)</div>
        <div class="user-profile"></div>
        <div class="display_image">
          <div class="tampil" id="display_image_h"></div>
          <img src="profile.png" alt="" />
        </div>
      </div>
    </header>
    <header class="second">
      <div class="text">Create Account</div>
    </header>
    <main class="wrapper-content">
      <div class="container-profile">
        <div class="wrapper-profile">
          <div class="profile-body">
            <div class="display_image">
              <div class="tampil" id="display_image"></div>
            </div>
          </div>
          <div class="text">
            <label for="upload" class="uploud-image">Pilih Gambar</label>
          </div>
          <input name="" type="file" id="upload" accept=".png, .jpg, .jpeg" style="visibility: hidden" />
        </div>
      </div>

      <?php $validation = \Config\Services::validation(); ?>
      <?php session()->get(); ?>
      <div class="wrapper-identity">
        <form action="<?= route_to('member.index.handler') ?>" method="post">
          <?= csrf_field() ?>


          <div class="identitas">
            <label for="nama">Nama Lengkap: </label>
            <input type="text" name="nama_lengkap" class="form-control" id=""
              value="<?= set_value('nama_lengkap') ?>" />
            <div class="pesan-error">
              <?= $validation->getError('nama_lengkap') ?>
            </div>
          </div>

          <div class="identitas">
            <label for="nis">NIS/NIM : </label>
            <input type="text" name="nis_nim" id="nis" value="<?= set_value('nis_nim') ?>" />
            <div class="pesan-error">
              <?= $validation->getError('nis_nim') ?>
            </div>
          </div>

          <div class="identitas">
            <label for="username">Username : </label>
            <input type="text" name="username" id="" value="<?= session()->get('akun_username'); ?>" readonly />
          </div>

          <div class="identitas">
            <label for="jenis-kelamin">Jenis Kelamin : </label>
            <select name="jenis_kelamin" id="">
              <option value="1">Pria</option>
              <option value="2">Wanita</option>
            </select>
          </div>

          <div class="identitas">
            <label for="telepon">No. Telepon :</label>
            <input placeholder="08xnxx" type="tel" name="no_hp" id="" pattern="[0-9]{4}[0-9]{4}[0-9]{5}"
              value="<?= set_value('no_hp') ?>" />
            <div class="pesan-error">
              <?= $validation->getError('no_hp') ?>
            </div>
          </div>

          <div class="identitas">
            <label for="email">Email :</label>
            <input type="email" name="email" id="" value="<?= session()->get('member_email'); ?>" readonly />
          </div>

          <div class="identitasInstansi" id="instansi">
            <div class="instansiAsal">
              <label for="Instansi">Instansi Pendidikan :</label>
              <select name="jenis_user" id="">
                <option value="1">Universitas</option>
                <option value="2">Sekolah</option>
              </select>
            </div>

            <div class="instansiNama">
              <label for="namaInstansi">Nama Instansi :</label>
              <input type="text" name="nama_instansi" id="" value="<?= set_value('nama_instansi') ?>" />
              <div class="pesan-error">
                <?= $validation->getError('nama_instansi') ?>
              </div>
            </div>

          </div>
          <div class="wrapper-submit">
            <input class="submit" name="submit" onclick="changeImage()" type="submit" value="Submit">

          </div>
        </form>
      </div>
    </main>
  </main>

  <script src="<?= base_url('admin'); ?>/js/script-index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>