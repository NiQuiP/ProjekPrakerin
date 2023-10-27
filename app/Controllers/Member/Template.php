<?php

namespace App\Controllers\Member;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\Absensi;



class Template extends BaseController
{

    function __construct()
    {
        helper("global_fungsi_helper");
        helper(["url", "form"]);
    }

    public function profil()
    {
        $data['aktif_profile'] = 'aktif';
        $member = new MemberModel();
        $username = session()->get("member_username");
        $memberInfo = $member->where('username', $username)->first();
        $data['namaFile'] = $memberInfo['foto'];
        $data['halaman'] = 'User | My Profile';
        $data['title'] = 'My Profile';
        echo view('member/v_sidebar', $data);
        echo view('member/v_my-profile', $data);
        echo view('member/v_footer', $data);
    }
    public function attendance()
    {
        $data['aktif_attendance'] = 'aktif';
        $member = new MemberModel();
        $username = session()->get("member_username");
        $memberInfo = $member->where('username', $username)->first();
        $data['namaFile'] = $memberInfo['foto'];
        $data['halaman'] = 'User | Attendance';
        $data['title'] = 'Attendance';
        echo view('member/v_sidebar', $data);

        echo view('member/v_attendance', $data);
        echo view('member/v_footer', $data);
    }
    public function permission()
    {
        $data['aktif_permission'] = 'aktif';
        $member = new MemberModel();
        $username = session()->get("member_username");
        $memberInfo = $member->where('username', $username)->first();
        $data['namaFile'] = $memberInfo['foto'];
        $data['halaman'] = 'User | Permission';
        $data['title'] = 'Permission';
        echo view('member/v_sidebar', $data);
        echo view('member/v_permission', $data);
        echo view('member/v_footer', $data);
    }

    public function history()
    {
        $data['aktif_history'] = 'aktif';
        $member = new MemberModel();
        $username = session()->get("member_username");
        $memberInfo = $member->where('username', $username)->first();
        $data['namaFile'] = $memberInfo['foto'];
        $data['halaman'] = 'User | History Absen';
        $data['title'] = 'History Absen';

        /** Data db */
        $absensi = new Absensi();
        $sesi_email = session()->get('member_email');
        $jumlahBaris = 5;
        $currentPage = $this->request->getVar('page_dt');
        $data['nomor'] = nomor($currentPage, $jumlahBaris);
        $data['dataAbsen'] = $absensi->where('email', $sesi_email)->orderBy('id', 'desc')->paginate($jumlahBaris);
        $data['pager'] = $absensi->pager;
        $data['nomor'] = ($this->request->getVar('page') == 1) ? '0' : $this->request->getVar('page');

        echo view('member/v_sidebar', $data);
        echo view('member/v_history', $data);
        echo view('member/v_footer', $data);
    }

    public function setting()
    {
        $data['aktif_setting'] = 'aktif';
        $member = new MemberModel();
        $username = session()->get("member_username");
        $memberInfo = $member->where('username', $username)->first();
        $data['namaFile'] = $memberInfo['foto'];
        $data['halaman'] = 'User | Setting';
        $data['title'] = 'Setting & Privacy';
        $data['email'] = $memberInfo['email'];
        $data['username'] = $memberInfo['username'];
        echo view('member/v_sidebar', $data);
        echo view('member/v_setting', $data);
        echo view('member/v_footer', $data);
    }

}