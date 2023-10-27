<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AdminModel;

class User extends BaseController
{
    function __construct()
    {
        $this->m_user = new UserModel();
        $this->m_admin = new AdminModel();
        $this->validation = \Config\Services::validation();
        helper("cookie");
        helper("global_fungsi_helper");
    }

    function sukses()
    {
        print_r(session()->get());
        echo 'ISIAN COOKIE USERNAME ' . get_cookie('cookie_username') . 'DAN PASSWORD'
            . get_cookie('cookie_password');
    }

    function logout()
    {
        delete_cookie('cookie_username');
        delete_cookie('cookie_password');
        session()->destroy();
        // session()->setFlashdata('success', 'berhasil logout');
        // return redirect()->to('/login');
        if (session()->get('akun_username') != '') {
            session()->setFlashdata("success", "Anda berhasil logout");
            return redirect()->to("/login");

        }
        echo view("user/login");
    }

    function user_lupapassword()
    {
        $err = [];
        if ($this->request->getMethod() == 'post') {
            $username = $this->request->getVar('username');
            if ($username == '') {
                $err[] = "Silahkan masukkan username atau email yang kamu punya";
            }
            if (empty($err)) {
                $dataAkun = $this->m_user->getData($username);
                if (empty($dataAkun)) {
                    $err[] = "Akun yang kamu masukkan tidak terdata";
                }
            }
            if (empty($err)) {
                $email = $dataAkun['email'];
                $token = md5(date('ymdhis'));

                $link = site_url("user/resetpassword/?email=$email&token=$token");
                $attachment = "";
                $to = "$email";
                $title = "Reset Password";
                $message = "Berikut ini adalah link untuk melakukan reset password anda";
                $message .= "Silahkan klik link berikut ini $link";

                kirim_email_user($attachment, $to, $title, $message);


                $dataUpdate = [
                    'email' => $email,
                    'token' => $token
                ];
                $this->m_user->updateData($dataUpdate);
                session()->setFlashdata("success", "Email untuk recovery sudah dikirimkan ke email kamu");
            }
            if ($err) {
                session()->setFlashdata('username', $username);
                session()->setFlashdata('warning', $err);
            }
            return redirect()->to('user/passwordlupa');
        }
        echo view('user/user_lupaPassword');
    }

    function user_resetpassword()
    {
        $err = [];
        $email = $this->request->getVar('email');
        $token = $this->request->getVar('token');
        if ($email != '' and $token != '') {
            $dataAkun = $this->m_user->getData($email);
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
                $this->m_user->updateData($dataUpdate);
                session()->setFlashdata('success', 'Password berhasil direset, silahkan login');
                delete_cookie('cookie_username');
                delete_cookie('cookie_password');
                return redirect()->to('/login')->withCookies();
            }

        }
        echo view('user/user_resetpassword');
    }
}