<?php

namespace App\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Tabungan;

class TabunganController extends BaseController
{


    public function __construct()
    {
        helper('form');
        $this->Anggota = new Anggota();
        $this->Sampah = new Sampah();
        $this->Tabungan = new Tabungan();
    }

    public function index()
    {
        $anggota = $this->Anggota->getSemuaDataAnggota();
        $data = [
            'title' =>     'Bank Sampah Dampit || Tabungan',
            'isi'   =>      'v_petugas/data_tabungan',
            'anggota' => $anggota,
        ];
        echo view('wrapper-petugas', $data);
    }

    public function riwayatTabungan()
    {
        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi'  => 'v_petugas/riwayat-tabungan',

        ];
        echo view('wrapper-petugas', $data);
    }
    public function riwayatTabunganAnggota()
    {

        $data = [
            'title' => 'Bank Sampah Dampit',
            'isi'  => 'v_anggota/riwayat_anggota',

        ];
        echo view('wrapper-anggota', $data);
    }
    public function ambilData()
    {
        $jenis = $_POST['jenis'];

        if ($jenis == 1) {
            $penarikan = $this->Tabungan->getSemuaPenarikan();

            echo json_encode($penarikan);
        } else if ($jenis == 2) {
            $tabungan = $this->Tabungan->getSemuaTabungan();

            echo json_encode($tabungan);
        }
    }
    public function ambilDataAnggota()
    {
        $jenis = $_POST['jenis'];

        $session = session()->get('username');
        $getid = $this->Anggota->getDataAnggota($session);
        $id = $getid['id_anggota'];

        if ($jenis == 1) {
            $penarikan = $this->Tabungan->getSemuaPenarikanbyID($id);

            echo json_encode($penarikan);
        } else if ($jenis == 2) {
            $tabungan = $this->Tabungan->getSemuaTabunganbyID($id);

            echo json_encode($tabungan);
        }
    }
}
