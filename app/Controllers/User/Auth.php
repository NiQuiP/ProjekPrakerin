<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    function __construct()
    {
        $this->m_user = new UserModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    function registrasi()
    {
        $username = $this->request->getVar('username');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $konfirmasi_password = $this->request->getVar('konfirmasi_password');
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => [
                    'rules' => 'required|min_length[5]|is_unique[user.username]',
                    'errors' => [
                        'required' => 'Username harus diisi',
                        'min_length' => 'Minimal username 5 karakter',
                        'is_unique' => 'Username yang anda masukkan sudah terdaftar'
                    ]
                ],
                'email' => [
                    'rules' => 'required|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Email harus diisi',
                        'is_unique' => 'Email yang anda masukkan sudah terdaftar'
                    ]
                ],

                'password' => [
                    'rules' => 'required|min_length[5]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Minimal password 5 karakter'

                    ]
                ],
                'konfirmasi_password' => [
                    'rules' => 'required|min_length[5]|matches[password]',
                    'errors' => [
                        'required' => 'Password harus diisi',
                        'min_length' => 'Minimal password 5 karakter',
                        'matches' => 'Konfirmasi password harus sama dengan password'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('warning', $this->validation->getErrors());
                session()->setFlashdata('username', $username);
                session()->setFlashdata('email', $email);
                return redirect()->to('/registrasi');
            } else {
                $tambahData = [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
                $this->m_user->updateData($tambahData);
                session()->setFlashdata('success', 'Akun berhasil dibuat');
                return redirect()->to('/login');
            }
        }
        echo view('user/registrasi');
    }

    public function login()
    {
        if (get_cookie('cookie_username') && get_cookie('cookie_password')) {
            $username = get_cookie('cookie_username');
            $password = get_cookie('cookie_password');

            $dataAkun = $this->m_user->getData($username);
            if ($password != $dataAkun['password']) {
                $err[] = 'Akun yang kamu masukkan tidak sesuai';
                return redirect()->to('/login');
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
                return redirect()->to('/login');
            }

            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $remember_me = $this->request->getVar('remember_me');

            $dataAkun = $this->m_user->getData($username);
            if (!password_verify($password, $dataAkun['password'])) {
                $err[] = 'Akun yang anda masukkan tidak sesuai';
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
                return redirect()->to('/login');
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
            return redirect()->to('user/sukses')->withCookies();
        }
        echo view('user/login', $data);
    }
}