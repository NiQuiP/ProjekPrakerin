<main class="wrapper-content-attendance">
    <!-- <header>Isi Kehadiran Anda</header> -->
    <div class="wrapper-body-attendance">
        <div class="body-satu-attendance">
            <div class="date">
                <div class="text">Waktu & Tanggal</div>
                <div class="date-time">
                    <h3 id="current-time"></h3>
                    <h3 id="date-today"></h3>
                </div>
            </div>
        </div>
        <div class="body-dua-attendance">
            <form action="<?= route_to('user.attendance') ?>" method="post" enctype="multipart/form-data">
                <div class="grid-satu-attendance">
                    <div class="wrapper-image">
                        <div class="image">
                            <video id="vid"></video>
                        </div>
                        <div class="text">
                            <button id="but" type="button">
                                <i class="fa-solid fa-camera"></i>
                            </button>
                        </div>
                    </div>
                    <div class="wrapper-maps">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="grid-dua-attendance">
                    <div class="wrapper-attendance">
                        <div class="hasilWrapper">
                            <h3>Hasil Gambar :</h3>
                            <canvas hidden> </canvas>
                            <img name="foto" for="absen" class="screenshot"
                                src="<?= base_url('admin') ?>/img/profile.png" alt="">
                            <input type="file" id="absen" name="foto_absen" hidden>
                        </div>
                        <div class="kbWrapper">
                            <div class="kordinatWrapper">
                                <div class="lat">latitude <span>:</span>
                                    <input type="text" name="lat" id="latitude" readonly /> <br />
                                </div>
                                <div class="long">longitude <span>:</span>
                                    <input type="text" name="long" id="longitude" readonly />
                                </div>
                            </div>
                            <div class="buttonWrapper">
                                <!-- <button type="submit" name="submit">Check-In</button> -->
                                <input type="submit" name="checkin" value="Check-In">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url('admin') ?>/js/script.js"></script>
</main>