<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\MemberModel;
use App\Models\UserModel;
use App\Models\Absensi;
use CodeIgniter\Pager\Pager;
use CodeIgniter\HTTP\RequestInterface;
use Config\Services;

class Admin extends BaseController
{
    function __construct()
    {
        $this->m_admin = new AdminModel();
        $this->m_user = new UserModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }
    public function login()
    {
        if (get_cookie('cookie_username') && get_cookie('cookie_password')) {
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAkun = $this->m_admin->getData($username);
            if ($password != $dataAkun['password']) {
                $err[] = 'Akun yang kamu masukkan tidak sesuai';
                return redirect()->to('admin/login');
            }

            $akun = [
                'akun_username' => $dataAkun['username'],
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email'],
            ];
            session()->set($akun);
            return redirect()->to('admin/sukses');
        }
        $data = [];
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'username harus diisi'
                    ]
                ],
                'password' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'password harus diisi'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
                return redirect()->to('admin/login');
            }

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            $dataAkun = $this->m_admin->getData($username);
            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = 'Akun yang anda masukkan tidak sesuai';
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to('admin/login');
            }

            if ($remember_me == '1') {
                set_cookie('cookie_username', $username, 3600 * 24 * 30);
                set_cookie('cookie_password', $dataAkun['password'], 3600 * 24 * 30);
            }

            $akun = [
                'akun_username' => $dataAkun['username'],
                'akun_nama_lengkap' => $dataAkun['nama_lengkap'],
                'akun_email' => $dataAkun['email'],
            ];
            session()->set($akun);
            if ($dataAkun['level'] == '1') {
                return redirect()->to('admin/article')->withCookies();

            }
            if ($dataAkun['level'] == '2') {
                echo 'hai';
            }
        }
        echo view('admin/login', $data);
    }

    function sukses()
    {
        return redirect()->to('admin/article');
        // $dataAkun = $this->m_admin->getData();
        // if ($dataAkun['level'] == 1) {
        //     return redirect()->to('admin/article');

        // } else {
        //     echo "ini user";
        // }
        // print_r(session()->get());
        // echo 'ISIAN COOKIE USERNAME ' . get_cookie('cookie_username') . 'DAN PASSWORD'
        //     . get_cookie('cookie_password');
    }

    function logout()
    {
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();
        if (session()->get('akun_username') != '') {
            session()->setFlashdata('success', 'Anda Berhasil Logout');

        }
        echo view('admin/v_login');
    }

    function lupapassword()
    {
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = "Silahkan masukkan username atau email yang kamu punya";
            }
            if (empty($err)) {
                $data = $this->m_admin->getData($username);
                if (empty($data)) {
                    $err[] = "Akun yang kamu masukkan tidak terdata";
                }
            }
            if (empty($err)) {
                $email = $data["email"];
                $token = md5(date('ymdhis'));

                $link = site_url("admin/resetpassword/?email=$email&token=$token");
                $attachment = "";
                $to = "$email";
                $title = "Reset Password";
                $message = "Berikut ini adalah link untuk melakukan reset password anda";
                $message .= "Silahkan klik link berikut ini $link";

                kirim_email($attachment, $to, $title, $message);


                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->m_admin->updateData($dataUpdate);
                session()->setFlashdata("success", "Email untuk recovery sudah dikirimkan ke email kamu");
            }
            if ($err) {
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
            }
            return redirect()->to('admin/lupapassword');
        }
        echo view('admin/v_lupaPassword');
    }

    function resetpassword()
    {
        $err = [];
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if ($email != '' and $token != '') {
            $dataAkun = $this->m_admin->getData($email);
            if ($dataAkun['token'] != $token) {
                $err[] = "Token tidak valid";
            }
        } else {
            $err[] = "Parameter yang dikirimkan tidak valid";
        }

        if ($err) {
            session()->setFlashdata('warning', $err);
        }

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk 
                        password adalah 5 karakter'
                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Konfirmasi password harus diisi',
                        'min_length' => 'Panjang karakter minimum untuk 
                    konfirmasi password adalah 5 karakter',
                        'matches' => 'Konfirmasi password tidak sesuai 
                    dengan password yang diisikan'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
            } else {
                $dataUpdate = [
                    'email' => $email,
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'token' => null
                ];
                $this->m_admin->updateData($dataUpdate);
                session()->setFlashdata('success', 'Password berhasil direset, silahkan login');
                delete_cookie('cookie_username');
                delete_cookie('cookie_password');
                return redirect()->to('admin/login')->withCookies();
            }

        }
        echo view('admin/v_resetpassword');
    }


    public function dashboard()
    {
        $absensi = new Absensi();
        $jumlahBaris = 5;

        $absensiInfo = $absensi->select('nim_nis, nama_lengkap, nama_instansi')->distinct('nim_nis')->get()->getResult();
        $totalAbsensi = [];
        foreach ($absensiInfo as $nim_nis) {
            $nimUser = $nim_nis->nim_nis;
            $totalAbsensi[$nimUser]['masuk'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Masuk');
            $totalAbsensi[$nimUser]['izin'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Izin');
            $totalAbsensi[$nimUser]['sakit'] = $absensi->getTotalAbsensiByStatus($nimUser, 'Sakit');
        }
        $user = new MemberModel();

        $jumlahSekolah = $user->getJumlahInstansi('sekolah');
        $jumlahUniv = $user->getJumlahInstansi('universitas');
        $totalSiswa = $user->getTotalUser('Siswa');
        $totalMahasiswa = $user->getTotalUser('Mahasiswa');
        $aktif_dashboard = 'aktif';

        $data = [
            'dataAbsen' => $absensiInfo,
            'totalAbsensi' => $totalAbsensi,
            'totalSekolah' => $jumlahSekolah,
            'totalUniv' => $jumlahUniv,
            'totalMahasiswa' => $totalMahasiswa,
            'totalSiswa' => $totalSiswa,
            'aktif_dashboard' => $aktif_dashboard
        ];
        return view('admin/v_dashboard', $data);
    }

    public function data_absen()
    {
        $absensi = new Absensi();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_absensi');
        $dataAbsen = $absensi->orderBy('id', 'desc')->paginate($jumlahBaris, 'absensi');
        $pager = $absensi->pager;
        $nomor = nomor($currentPage, $jumlahBaris);

        $data = [
            'dataAbsen' => $dataAbsen,
            'pager' => $pager,
            'nomor' => $nomor,

        ];
        return view('admin/v_dataAbsen', $data);
    }

    public function data_siswa()
    {
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_siswa');
        $dataSiswa = $user->where('jenis_user', 'Siswa')->findAll();
        $nomor = nomor($currentPage, $jumlahBaris);

        $data = [
            'dataSiswa' => $dataSiswa,
            'nomor' => $nomor,

        ];

        return view('admin/v_dataSiswa', $data);
    }
    public function data_mahasiswa()
    {
        $user = new MemberModel();
        $jumlahBaris = 10;
        $currentPage = $this->request->getVar('page_mahasiswa');
        $dataMahasiswa = $user->where('jenis_user', 'mahasiswa')->paginate($jumlahBaris, 'mahasiswa');
        $pager = $user->pager;
        $nomor = nomor($currentPage, $jumlahBaris);

        $data = [
            'dataMahasiswa' => $dataMahasiswa,
            'pager' => $pager,
            'nomor' => $nomor,

        ];

        return view('admin/v_dataMahasiswa', $data);
    }
}