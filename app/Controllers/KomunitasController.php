<?php

namespace App\Controllers;

use App\Models\Komunitas;
use App\Models\Volunteer;
use App\Models\Laporan;
use CodeIgniter\HTTP\Request;

class KomunitasController extends BaseController
{

    //buka halaman untuk menelusuri semua komunitas yang ada
    public function index()
    {
        session();
        $komunitas = new Komunitas();
        $kom = $komunitas->getSemuaKomunitas();

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_komunitas',
            'komunitas' => $kom
        ];
        echo view('wrapper1', $data);
    }

    //buka halaman detail dari salah satu komunitas
    public function detailKomunitas()
    {
        $komunitas = new Komunitas();
        $volunteer = new Volunteer();
        $id_komunitas = $this->request->uri->getSegment(2);
        $id = session()->get('id');
        $keanggotaan = $komunitas->getVolunteerKomunitas($id);
        $kom = $komunitas->getKomunitas($id_komunitas);
        $pendiri = $volunteer->getDataVolunteerByIdVolunteer($kom['pendiri']);
        $dataVol = $volunteer->getDataVolunteerByKomunitas($kom['id_komunitas']);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_detailKomunitas',
            'komunitas' => $kom,
            'keanggotaan' => $keanggotaan,
            'pendiri' => $pendiri['id'],
            'anggota' => count($dataVol)
        ];
        echo view('wrapper1', $data);
    }

    //buka halaman form pembuatan komunitas
    public function buatKomunitas()
    {
        $volunteer = new Volunteer();
        $username = session()->get('username');
        $vol = $volunteer->getDataVolunteer($username);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_buatKomunitas',
            'kom'   =>    $vol['id_komunitas']

        ];
        echo view('wrapper1', $data);
    }

    //fungsi untuk mengirimkan data dari form pembuatan komunitas kedalam database
    public function KirimKomunitas()
    {
        $komunitas = new Komunitas();
        $volunteer = new Volunteer();
        $i = date('Y-m-d');
        $id_volunteer = $volunteer->getIdVolunteer(session()->get('id'));
        $komunitas->set_nama_komnitas($this->request->getVar('nama'));
        $komunitas->set_tanggal_berdiri($i);
        $komunitas->set_nomor_kontak($this->request->getVar('no_kontak'));
        $komunitas->set_biodata_komnitas($this->request->getVar('bio'));
        $komunitas->set_pendiri_komunitas($id_volunteer['id_volunteer']);


        $komunitas->buatKomunitas();

        $id_komunitas = $komunitas->insertID();
        $komunitas->pemilikKomunitas($id_volunteer, $id_komunitas);
        return redirect()->to('/home');
    }

    //fungsi untuk volunteer mendaftarkan diri kedalam komunitas
    public function DaftarKomunitas()
    {
        $volunteer = new Volunteer();
        $id_komunitas = $this->request->uri->getSegment(2);
        $id_pengguna = session()->get('id');

        $volunteer->gabungKomunitas($id_komunitas, $id_pengguna);

        return redirect()->to('/home');
    }

    //buka profil dari pendiri komunitas
    public function ProfilPendiri()
    {
        $volunteer = new Volunteer();
        $laporan = new Laporan();
        $komunitas = new Komunitas();
        $id_profil = $this->request->uri->getSegment(2);

        $relawan = $volunteer->getDataVolunteerByIdVolunteer($id_profil);
        $lapor = $laporan->getLaporanbyID($relawan['id_volunteer'], 2);

        $jumlahlaporan = $laporan->getLaporanbyID($relawan['id_volunteer'], null);
        $i = count($jumlahlaporan);
        $getKomunitas = $relawan['id_komunitas'];
        $kom = $komunitas->getKomunitas($getKomunitas);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_profilVolunteer',
            'volunteer' => $relawan,
            'laporan' => $lapor,
            'jumlah'  => $i,
            'komunitas' => $kom
        ];
        echo view('wrapper1', $data);
    }

    public function daftarAnggotaKomunitas()
    {
        $komunitas = new Komunitas();
        $volunteer = new Volunteer();
        $id_komunitas = $this->request->uri->getSegment(2);
        $id = session()->get('id');
        $keanggotaan = $komunitas->getVolunteerKomunitas($id);
        $kom = $komunitas->getKomunitas($id_komunitas);
        $dataVol = $volunteer->getDataVolunteerByKomunitas($kom['id_komunitas']);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_daftar_anggota_komunitas',
            'komunitas' => $kom,
            'keanggotaan' => $keanggotaan,
            'anggota' => $dataVol

        ];
        echo view('wrapper1', $data);
    }

    public function komunitasSaya()
    {
        $komunitas = new Komunitas();
        $volunteer = new Volunteer();
        $id = session()->get('id');

        $keanggotaan = $komunitas->getVolunteerKomunitas($id);
        $kom = $komunitas->getKomunitas($keanggotaan);

        if (!empty($kom)) {
            $pendiri = $volunteer->getDataVolunteerByIdVolunteer($kom['pendiri']);
            $dataVol = $volunteer->getDataVolunteerByKomunitas($kom['id_komunitas']);


            $data = [
                'title' =>     'Bank Sampah Dampit bos',
                'isi'   =>      'v_volunteer/v_detailKomunitas',
                'komunitas' => $kom,
                'keanggotaan' => $keanggotaan,
                'pendiri' => $pendiri['id'],
                'anggota' => count($dataVol)
            ];
            echo view('wrapper1', $data);
        } else {
            $data = [
                'title' =>     'Bank Sampah Dampit bos',
                'isi'   =>      'v_volunteer/v_komunitasSaya',
                'komunitas' => $kom,
                'keanggotaan' => $keanggotaan,
            ];
            echo view('wrapper1', $data);
        }
    }
}
