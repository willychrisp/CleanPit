<?php

namespace App\Controllers;

use App\Models\AkunPengguna;
use App\Models\Volunteer;

class AuthController extends BaseController
{
    protected $AkunPengguna;
    public function __construct()
    {
        $a = 1;
        $hari = date("d");
        $bulan = date("m");

        if ($hari == "1" && $bulan == "1") {
            $a = 12;
        } else {
            $a = 10;
        }
        helper('form');
        $this->AkunPengguna = new AkunPengguna();
        $this->Volunteer = new Volunteer();
    }

    //buka halaman login
    public function index()
    {
        $data = [
            'title' =>     'Bank Sampah Dampit || Login',
            'isi'   =>      'v_user/v_login'
        ];
        echo view("layout/v_content", $data);
    }

    //buka halaman daftar volunteer
    public function register()
    {

        $data = [
            'title' =>     'Bank Sampah Dampit || Register',
            'isi'   =>      'v_user/v_register'
        ];
        echo view("layout/v_content", $data);
    }

    //cek ketersediaan username
    public function usernameAvailability()
    {
        $uname = $this->AkunPengguna->getUsername($_POST["username"]);

        if (!empty($uname)) {
            echo '
            <div class="alert alert-warning">Username tidak tersedia</div>';
        } else {
            echo '
            <div class="alert alert-success">Username tersedia</div>';
        }
    }

    //kirim data registrasi volunteer
    public function DaftarVolunteer()
    {

        $fileFotoKTP = $this->request->getFile('foto-ktp');
        $fileFoto = $this->request->getFile('foto-profil');
        if (!empty($fileFoto)) {

            $fileFoto->move('img/data_volunteer');
            $namaFoto = $fileFoto->getName();
        }
        if (empty($fileFoto)) {
            $namaFoto = "user.png";
        }
        $fileFotoKTP->move('img/data_volunteer/foto_ktp');

        $namaKtp = $fileFotoKTP->getName();
        //dd($fileFoto); 
        $this->AkunPengguna->set_username($this->request->getVar('username'));
        $this->AkunPengguna->set_password($this->request->getVar('password'));

        $this->AkunPengguna->regisVolunteer();



        $id_pengguna = $this->AkunPengguna->InsertID();

        $this->Volunteer->set_nama_volunteer($this->request->getVar('nama'));
        $this->Volunteer->set_alamat_volunteer($this->request->getVar('alamat'));
        $this->Volunteer->set_tanggal_lahir($this->request->getVar('tanggal'));
        $this->Volunteer->set_foto_volunteer($namaFoto);
        $this->Volunteer->set_foto_ktp($namaKtp);
        $this->Volunteer->set_kontak_volunteer($this->request->getVar('hp'));
        $this->Volunteer->set_bo_volunteer($this->request->getVar('biodata'));

        $this->Volunteer->regisVolunteer($id_pengguna);

        return redirect()->to('/');
    }

    //Login Volunteer
    public function Login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $cek = $this->AkunPengguna->cekLogin($username, $password);
        if ($cek > 0) {
            if ($cek['role'] == 1) {
                session()->set('log', true);
                session()->set('id', $cek['id']);
                session()->set('username', $cek['username']);
                session()->set('role', $cek['role']);
                return redirect()->to('/home');
            } else if ($cek['role'] == 2) {
                session()->set('log1', true);
                session()->set('id', $cek['id']);
                session()->set('username', $cek['username']);
                session()->set('role', $cek['role']);
                return redirect()->to('/home-anggota');
            } else if ($cek['role'] == 3) {
                session()->set('log2', true);
                session()->set('id', $cek['id']);
                session()->set('username', $cek['username']);
                session()->set('role', $cek['role']);
                return redirect()->to('/home-petugas');
            } else if ($cek['role'] == 4) {
                session()->set('log3', true);
                session()->set('id', $cek['id']);
                session()->set('username', $cek['username']);
                session()->set('role', $cek['role']);
                return redirect()->to('/home-admin');
            }
        } else if ($cek == 0) {
            session()->setFlashdata('pesan', 'Ada kesalahan ketika login');
            return redirect()->to('/login');
        }
    }

    //Logout Volunteer
    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('role');
        session()->setFlashdata('pesan', 'Logout sukses');
        return redirect()->to('/');
    }
    //Logout Anggota
    public function logoutAnggota()
    {
        session()->remove('log1');
        session()->remove('username');
        session()->remove('role');
        session()->setFlashdata('pesan', 'Logout sukses');
        return redirect()->to('/');
    }

    public function logoutPetugas()
    {
        session()->remove('log2');
        session()->remove('username');
        session()->remove('role');
        session()->setFlashdata('pesan', 'Logout sukses');
        return redirect()->to('/');
    }

    public function logoutAdmin()
    {
        session()->remove('log3');
        session()->remove('username');
        session()->remove('role');
        session()->setFlashdata('pesan', 'Logout sukses');
        return redirect()->to('/');
    }



    //--------------------------------------------------------------------

}
