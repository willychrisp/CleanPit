<?php

namespace App\Controllers;



class HomeController extends BaseController
{
    public function index()
    {
        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_user/v_homeUser'
        ];
        echo view('wrapper', $data);
    }

    //halaman home ketika volunteer berhasil login
    public function volunteerHome()
    {
        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/home'
        ];
        echo view('wrapper2', $data);
    }

    //halaman home ketika anggota berhasil login
    public function AnggotaHome()
    {
        $session = session()->get('role');
        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi' => 'v_anggota/landing_page_anggota',
            'role' => $session
        ];
        echo view('wrapper3', $data);
    }

    public function AnggotaHomeBank()
    {
        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi' => 'v_anggota/home_anggota'
        ];
        echo view('wrapper-anggota', $data);
    }

    public function PetugasHomeBank()
    {
        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi' => 'v_petugas/home_petugas'
        ];
        echo view('wrapper-petugas', $data);
    }
    public function AdminHome()
    {
        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi' => 'v_admin/home_admin'
        ];
        echo view('wrapper-admin', $data);
    }
}
