<?php

namespace App\Controllers;

use App\Models\KerjaBakti;
use App\Models\Laporan;
use App\Models\LaporanKegiatan;
use App\Models\Volunteer;

class LaporanController extends BaseController
{
    //buka halaman form pengiriman laporan
    public function index()
    {
        session();
        $session = session()->get('role');
        if ($session == null) {
            $session = 0;
        }
        if ($session == 1) {
            $data = [
                'title' =>     'Bank Sampah Dampit bos',
                'isi'   =>      'v_volunteer/v_laporLingkungan',
                'role'  => $session

            ];
        } else {
            $data = [
                'title' =>     'Bank Sampah Dampit bos',
                'isi'   =>      'v_user/v_kirim_laporanUser',
                'role' => $session

            ];
        }
        if ($session == 1) {
            echo view('wrapper1', $data);
            return;
        } else if ($session == 2 || $session == 3) {
            echo view('wrapper3', $data);
            return;
        } else if ($session == null) {
            echo view('wrapper', $data);
            return;
        }
    }
    //mengirimkan data yang sudah di inputkan pada form kedalam database
    public function kirimLaporan()
    {
        $laporan = new Laporan();
        $volunteer = new Volunteer();
        $fileFoto = $this->request->getFile('foto');
        $fileFoto->move('img');
        $namaFoto = $fileFoto->getName();
        $tanggal = date($this->request->getPost('tanggal'));
        $jenis = $this->request->getPost('jenis');
        if ($jenis == "1") {
            $id_volunteer = $volunteer->getIdVolunteer(session()->get('id'));
            $laporan->set_pengirim_laporan($id_volunteer['id_volunteer']);
        } else if ($jenis == "2") {
            $laporan->set_identitas_pengirim($this->request->getPost('identitas'));
            $laporan->set_nomor_pengirim($this->request->getPost('nomor'));
        } else if ($jenis == "3") {
            $laporan->set_identitas_pengirim($this->request->getPost('identitas'));
            $laporan->set_nomor_pengirim($this->request->getPost('nomor'));
        }
        $laporan->set_nama_laporan($this->request->getPost('nama'));
        $laporan->set_isi_laporan($this->request->getPost('isi'));
        $laporan->set_tanggal_laporan($tanggal);
        $laporan->set_lokasi_laporan($this->request->getPost('lokasi'));
        $laporan->set_wilayah($this->request->getPost('wilayah'));
        $laporan->set_objek($this->request->getPost('objek'));
        $laporan->set_foto_laporan($namaFoto);

        if ($jenis == "1") {
            $kirim = $laporan->sendLaporan();
        } else if ($jenis == "2") {
            $kirim = $laporan->sendLaporanUser($jenis);
        } else if ($jenis == "3") {
            $kirim = $laporan->sendLaporanUser($jenis);
        }


        //dd($fileFoto);
        if ($kirim == true) {
            return redirect()->to('/');
        } else {
            return redirect()->to('/lapor');
        }
    }


    //Mengirimkan data kegiatan oleh pengurus
    public function kirimKegiatan($id_laporan)
    {
        $kegiatan = new KerjaBakti();

        $kegiatan->setTanggalKegiatan($this->request->getPost('tanggal'));
        $kegiatan->setLokasiKegiatan($this->request->getPost('lokasi'));

        $kirim = $kegiatan->sendKegiatan($id_laporan);
        if ($kirim == true) {
            return redirect()->to('/partisipan-petugas/' . $id_laporan);
        } else {
            return redirect()->to('/home');
        }
    }
    //Mengirimkan laporan kegiatan oleh pengurus
    public function kirimLaporanKegiatan($id_laporan)
    {
        $laporanKegiatan = new LaporanKegiatan();

        $laporanKegiatan->setJumlahVolunteer($this->request->getPost('peserta'));
        $laporanKegiatan->setIsiLaporan($this->request->getPost('isi'));

        $kirim = $laporanKegiatan->sendLaporanKegiatan($id_laporan);
        if ($kirim == true) {
            return redirect()->to('/partisipan-petugas/' . $id_laporan);
        } else {
            return redirect()->to('/home');
        }
    }


    //melihat laporan yang sudah dikirimkan sendiri
    public function lihatLaporanTerkirim()
    {
        session();
        $volunteer = new Volunteer();
        $laporan = new Laporan();
        $session = session()->get('username');

        $volunteer = $volunteer->getDataVolunteer($session);

        $laporan = $laporan->getLaporanbyID($volunteer['id_volunteer'], null);
        $i = count($laporan);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_laporanPage',
            'volunteer' => $volunteer,
            'laporan' => $laporan,
            'jumlah'  => $i
        ];
        echo view('wrapper1', $data);
    }

    //buka detail dari laporan yang dikirimkan oleh orang lain
    public function lihatLaporanOrang()
    {
        session();
        $Volunteer = new Volunteer();
        $Laporan = new Laporan();
        $id_profil = $this->request->uri->getSegment(2);

        $volunteer = $Volunteer->getDataVolunteerById($id_profil);


        $laporan = $Laporan->getLaporanbyID($volunteer['id_volunteer'], null);

        $i = count($laporan);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_laporanPage',
            'volunteer' => $volunteer,
            'laporan' => $laporan,
            'jumlah'  => $i
        ];
        echo view('wrapper1', $data);
    }

    //membuka halaman penelusuran laporan yang pernah dikirimkan oleh siapa saja
    public function lihatSemuaLaporan()
    {
        $session = session()->get('role');
        $Laporan = new Laporan();
        $a = 1;
        $b = 3;
        $c = 2;
        $laporan = $Laporan->getLaporanData($a);
        $laporanUmum = $Laporan->getLaporanDataUmum($a, $b);
        $laporanPetugas = $Laporan->getLaporanDataUmum($a, $c);
        $i = count($laporan);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_semualaporanPage',
            'laporan' => $laporan,
            'laporanUmum' => $laporanUmum,
            'laporanPetugas' => $laporanPetugas,
            'jumlah'  => $i,
            'role' => $session
        ];
        if ($session == 1) {
            echo view('wrapper1', $data);
        } else if ($session == null) {
            echo view('wrapper', $data);
        } else if ($session == 2 || 3) {
            echo view('wrapper3', $data);
        }
    }
}
