<?php

namespace App\Controllers;

use App\Models\Laporan;
use App\Models\Volunteer;

class VerifikasiController extends BaseController
{
    public function __construct()
    {
        $this->Laporan = new Laporan();
        $this->Volunteer = new Volunteer();
    }
    public function index()
    {
    }

    public function laporanPage()
    {
        $a = 0;
        $laporan = $this->Laporan->getLaporanData($a);
        $i = count($laporan);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_admin/verifikasi-laporan',
            'laporan' => $laporan,
            'jumlah'  => $i
        ];
        echo view('wrapper-admin', $data);
    }
    public function volunteerPage()
    {
        $a = 0;
        $relawan = $this->Volunteer->getVolunteerData($a);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_admin/verifikasi-pengguna',
            'volunteer' => $relawan,

        ];
        echo view('wrapper-admin', $data);
    }
    public function verifikasiLaporan()
    {
        $act = $this->request->uri->getSegment(2);
        if ($act == 1) {
            $a = 1;
            $this->Laporan->set_status_laporan($a);
            $this->Laporan->verifikasiLaporan($this->request->uri->getSegment(3));
        } else {
            $this->Laporan->deleteLaporan($this->request->uri->getSegment(3));
        }

        return redirect()->to('/verifikasi-laporan');
    }

    public function verifikasiPengguna()
    {
        $act = $this->request->uri->getSegment(2);
        if ($act == 1) {
            $a = 1;
            $this->Volunteer->set_status($a);
            $this->Volunteer->verifikasiPengguna($this->request->uri->getSegment(3));
        } else {
            $this->Volunteer->deletePengguna($this->request->uri->getSegment(3));
        }

        return redirect()->to('/verifikasi-laporan');
    }


    public function deleteVolunteer($id_volunteer)
    {
        $this->Volunteer->delete($id_volunteer);
    }
}
