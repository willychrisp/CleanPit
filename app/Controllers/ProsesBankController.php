<?php

namespace App\Controllers;

use App\Models\Anggota;
use App\Models\Sampah;
use App\Models\Tabungan;
use App\Models\AkunPengguna;


class ProsesBankController extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->Anggota = new Anggota();
        $this->Sampah = new Sampah();
        $this->Tabungan = new Tabungan();
        $this->AkunPengguna = new AkunPengguna();
    }

    public function index()
    {
        $anggota = new Anggota();
        $session = session()->get('username');
        $anggotaBS = $anggota->getSemuaDataAnggota();
        $data = [
            'title' =>     'Bank Sampah Dampit',
            'isi'   =>      'v_petugas/isi_tabungan',
            'anggota' => $anggotaBS,
        ];
        echo view('wrapper-petugas', $data);
    }

    public function rekap()
    {
        $tabungan = new Tabungan();
        $data = $tabungan->getSemuaTabungan();

        $a = 0;
        for ($i = 0; $i < count($data); $i++) {
            $a += (intval($data[$i]['harga_sampah']) * intval($data[$i]['jumlah_sampah']));
        }

        $tarik = $this->Tabungan->getSemuaPenarikan();
        $b = 0;
        for ($i = 0; $i < count($tarik); $i++) {
            $b += intval($tarik[$i]['jumlah_penarikan']);
        }
        $data = [
            'title' =>     'Bank Sampah Dampit || Rekap',
            'isi'   =>      'v_petugas/rekap',
            'total_masuk' => $a,
            'total_tarik' => $b

        ];
        echo view('wrapper-petugas', $data);
    }
    public function inputTabungan()
    {
        $anggota = new Anggota();
        $sampah = new Sampah();
        $tabungan = new Tabungan();
        $id = $this->request->uri->getSegment(2);
        $anggotaBS = $anggota->getDatabyIdAnggota($id);
        $datasampah = $sampah->getSemuaDataSampah();
        $datatabungan = $tabungan->getTabunganById($id);

        $data = [
            'title' => 'Bank Sampah Dampit || Tabungan',
            'isi' => 'v_petugas/input_tabungan',
            'anggota' => $anggotaBS,
            'sampah'  => $datasampah,
            'tabungan' => $datatabungan

        ];

        echo view('wrapper-petugas', $data);
    }
    //halaman harga sampah universal
    public function hargaSampahP()
    {
        $session = session()->get('role');
        $sampah = new Sampah();
        $dataSampah = $sampah->getSemuaDataSampah();
        $data = [
            'title' => 'Bank Sampah Dampit || Harga Sampah',
            'isi' => 'v_petugas/daftar_harga_sampah',
            'sampah' => $dataSampah,
            'role' => $session
        ];
        if ($session == 3) {
            echo view('wrapper-petugas', $data);
        } else {
            echo view('wrapper-anggota', $data);
        }
    }
    public function hargaSampahPage()
    {
        $data = [
            'title' => 'Bank Sampah Dampit || Harga Sampah',
            'isi' => 'v_petugas/harga_sampah'
        ];

        echo view('wrapper-petugas', $data);
    }

    //Fungsi untuk mengambil data tabungan tiap anggota
    public function ambilDataTabungan()
    {
        $tabung = new Tabungan();
        $id = $_POST["id"];
        $tabungan = $tabung->getTabunganById($id);
        echo json_encode($tabungan);
    }
    //Fungsi untuk mengambil data sampah keseluruhan
    public function ambilDataSampah()
    {
        $data = $this->Sampah->getSemuaDataSampah();
        echo json_encode($data);
    }
    //Fungsi untuk menghitung total tabungan pada hari ini
    public function totalHariIni()
    {
        $tabung = new Tabungan();
        $id = $_POST["id"];
        $path = $_POST["path"];
        if ($path == 1) {
            $tabungan = $tabung->getTabunganById($id);
            $a = 0;
            for ($i = 0; $i < count($tabungan); $i++) {
                $a += (intval($tabungan[$i]['jumlah_tabungan']));
            }
            echo json_encode($a);
        } else if ($path == 2) {
            $tabungan = $tabung->getSemuaTabunganbyID($id);
            $a = 0;
            for ($i = 0; $i < count($tabungan); $i++) {
                $a += (intval($tabungan[$i]['jumlah_tabungan']));
            }
            echo json_encode($a);
        }
    }
    //Fungsi untuk menghitung total tabungan berdasarkan berat dan jenis sampah
    public function hitungBerat()
    {
        $sampah = new Sampah();
        $harga = $sampah->getHarga($_POST["sampah"]);
        $jumlah = $_POST["berat"];
        $i = (int)$harga[0]->harga_sampah;
        $k = (float)$jumlah;
        $total = $i * $k;
        echo json_encode($total);
    }

    public function kirimTabungan()
    {
        $tabung = new Tabungan();
        $sampah = $_POST['sampah_id'];
        $berat = $_POST['berat'];
        if ($sampah == '') {
            $result['pesan'] = "Nama sampah harus diisi";
        } elseif ($berat == '') {
            $result['pesan'] = "Berat sampah harus diisi";
        } else {
            $result['pesan'] = "data tabungan berhasil dikirimkan";
            $tabung->set_jumlah_sampah($_POST["berat"]);
            $tabung->set_jumlah_tabungan($_POST["total"]);
            $tabung->set_pemilik_data($_POST["id_anggota"]);
            $data_tabungan = $_POST["sampah_id"];

            $tabung->kirimDataTabungan($data_tabungan);
        }

        echo json_encode($result);
    }
    //Fungsi untuk mendapatkan data tabungan dari anggota tertentu
    public function ambilSemuaDataTabungan()
    {
        $tabung = new Tabungan();
        $id = $_POST["id"];
        $tabungan = $tabung->getSemuaTabunganbyID($id);
        echo json_encode($tabungan);
    }
    //Fungsi untuk mendapatkan data tabungan keseluruhan anggota
    public function ambilSemuaDataTabunganBank()
    {
        $tabung = new Tabungan();
        $tabungan = $tabung->getSemuaTabungan();
        echo json_encode($tabungan);
    }
    //Fungsi untuk mendapatkan data penarikan keseluruhan anggota
    public function ambilSemuaDataPenarikanBank()
    {
        $tabung = new Tabungan();
        $penarikan = $tabung->getSemuaPenarikan();
        echo json_encode($penarikan);
    }
    //Buku tabungan oleh aktor petugas
    public function bukuTabungan()
    {
        $angota = new Anggota();
        $tabung = new Tabungan();
        $id = $this->request->uri->getSegment(2);
        $anggota = $angota->getDatabyIdAnggota($id);
        $tabungan = $tabung->getSemuaTabunganbyId($id);
        $a = 0;
        for ($i = 0; $i < count($tabungan); $i++) {
            $a += (intval($tabungan[$i]['harga_sampah']) * intval($tabungan[$i]['jumlah_sampah']));
        }
        $tarik = $tabung->getJumlahPenarikan($id);
        $b = 0;
        for ($i = 0; $i < count($tarik); $i++) {
            $b += intval($tarik[$i]['jumlah_penarikan']);
        }
        $c = $a + $b;

        $data = [
            'title' => 'Bank Sampah Dampit || Buku Tabungan',
            'isi' => 'v_petugas/buku-tabungan',
            'anggota' => $anggota,
            'total'   => $c
        ];
        echo view('wrapper-petugas', $data);
    }

    //Buku tabungan oleh aktor anggota bank sampah
    public function bukuTabunganAnggota()
    {
        $username = session()->get('username');

        $anggota = $this->Anggota->getDataAnggota($username);
        $id = $anggota['id_anggota'];
        $tabungan = $this->Tabungan->getSemuaTabunganbyId($id);
        $a = 0;
        for ($i = 0; $i < count($tabungan); $i++) {
            $a += (intval($tabungan[$i]['harga_sampah']) * intval($tabungan[$i]['jumlah_sampah']));
        }
        $tarik = $this->Tabungan->getJumlahPenarikan($id);

        $b = 0;
        for ($i = 0; $i < count($tarik); $i++) {
            $b += intval($tarik[$i]['jumlah_penarikan']);
        }
        $c = $a + $b;

        $data = [
            'title' => 'Bank Sampah Dampit || Buku Tabungan',
            'isi' => 'v_anggota/bukuTabungan_anggota',
            'anggota' => $anggota,
            'total'   => $c
        ];
        echo view('wrapper-anggota', $data);
    }

    public function ambilSaldoTabungan()
    {
        $id = $_POST["id"];
        $tabungan = $this->Tabungan->getSemuaTabunganbyId($id);
        $a = 0;
        for ($i = 0; $i < count($tabungan); $i++) {
            $a += (intval($tabungan[$i]['harga_sampah']) * intval($tabungan[$i]['jumlah_sampah']));
        }
        echo json_encode($a);
    }


    public function ambilDataPenarikan()
    {
        $id = $_POST["id"];
        $tabungan = $this->Tabungan->getJumlahPenarikan($id);
        $a = 0;
        for ($i = 0; $i < count($tabungan); $i++) {
            $a += intval($tabungan[$i]['jumlah_penarikan']);
        }
        echo json_encode($a);
    }



    public function kirimPenarikan()
    {
        if ($_POST['nominal'] == '') {
            $result['pesan'] = "nominal harus diisi";
        } else {
            $result['pesan'] = "";
            $penarikan = -1 * abs($_POST["nominal"]);

            $this->Tabungan->set_jumlah_penarikan($penarikan);
            $this->Tabungan->set_pemilik_data($_POST["id_anggota"]);
            $this->Tabungan->insertPenarikan();
        }
        echo json_encode($result);
    }

    public function anggota_bs()
    {

        $anggota = $this->Anggota->getSemuaDataAnggota();
        $aktif = $this->Anggota->jumlahAktif();

        $data = [
            'title' =>     'Bank Sampah Dampit || Anggota',
            'isi'   =>      'v_petugas/anggota_bs',
            'anggota' => $anggota,
            'aktif' => count($aktif)
        ];
        echo view('wrapper-petugas', $data);
    }

    public function tambahAnggota()
    {
        $data = [
            'title' => 'Bank Sampah Dampit || Tambah Anggota Baru',
            'isi' => 'v_petugas/tambah_anggota'
        ];
        echo view('wrapper-petugas', $data);
    }
    public function kirimDataAnggota()
    {
        $anggota = new Anggota();
        $akun = new AkunPengguna();
        $jumlah = (count($anggota->getSemuaDataAnggota())) + 1;
        $username = "05.07.108.$jumlah";

        $password = "507108$jumlah";
        $hp = $this->request->getVar('hp');
        $nomor = "+62$hp";
        $akun->set_username($username);
        $akun->set_password($password);
        $akun->regisAnggota();

        $id_pengguna = $akun->InsertID();

        $anggota->set_nama_anggota($this->request->getVar('nama'));
        $anggota->set_alamat_anggota($this->request->getVar('alamat'));
        $anggota->set_tanggal_bergabung($this->request->getVar('tanggal'));

        $anggota->set_kontak_anggota($nomor);
        $anggota->set_bio_anggota($this->request->getVar('biodata'));


        $anggota->tambahAnggota($id_pengguna);


        return redirect()->to("https://api.whatsapp.com/send?phone=$nomor&text=Username:%20$username%20%0DPassword:%20$password");
    }

    public function updateHargaSampah()
    {
        $sampah = new Sampah();
        $id = $_POST['id'];
        $column_name = $_POST['table_column'];
        $value = $_POST['value'];
        $data = array(
            $column_name => $value
        );
        $baru = $sampah->updateSampah($id, $data);
        if ($baru == true) {
            $result['pesan'] = "berhasil memperbarui data";
        } else {
            $result['pesan'] = "gagal memperbarui data";
        }
        echo json_encode($result);
    }

    public function tambahKeterangan()
    {
        $anggota = new Anggota();
        $id = $_POST['id'];
        $value = $_POST['value'];
        $data = array(
            'bio_anggota' => $value
        );
        $baru = $anggota->keterangan($id, $data);
        if ($baru == true) {
            $result['pesan'] = "berhasil memperbarui data";
        } else {
            $result['pesan'] = "gagal memperbarui data";
        }
        echo json_encode($result);
    }
    public function ubahStatus($id)
    {
        $anggota = new Anggota();
        $status = $this->request->uri->getSegment(4);
        if ($status == 0) {
            $a = -1;
            $anggota->ubahStatus($id, $a);
        } else {
            $a = 0;
            $anggota->ubahStatus($id, $a);
        }
        return redirect()->to('/anggota-bs');
    }
}
